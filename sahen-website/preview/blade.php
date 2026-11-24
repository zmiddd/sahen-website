<?php
/**
 * Mini kompilator Blade untuk PRATINJAU tanpa Laravel.
 * Hanya mendukung subset direktif yang dipakai pada resources/views.
 * Tidak digunakan oleh aplikasi Laravel yang sesungguhnya.
 */

class MiniBlade
{
    private string $dir;
    private array $sections = [];

    public function __construct(string $viewDir)
    {
        $this->dir = rtrim($viewDir, '/');
    }

    public function render(string $view, array $vars = []): string
    {
        $this->sections = [];
        return $this->renderView($view, $vars);
    }

    private function renderView(string $view, array $vars): string
    {
        $file = $this->dir.'/'.str_replace('.', '/', $view).'.blade.php';
        if (! is_file($file)) {
            throw new RuntimeException("View tidak ditemukan: $view");
        }
        $src = file_get_contents($file);
        $parent = null;
        if (preg_match("/@extends\\(\\s*'([^']+)'\\s*\\)/", $src, $m)) {
            $parent = $m[1];
            $src = str_replace($m[0], '', $src);
        }
        $code = $this->compile($src);
        $out = $this->execute($code, $vars);
        if ($parent) {
            return $this->renderView($parent, $vars);
        }
        return $out;
    }

    private function execute(string $code, array $vars): string
    {
        $__blade = $this;
        $__sections = &$this->sections;
        $__file = tempnam(sys_get_temp_dir(), 'blade_');
        file_put_contents($__file, $code);
        extract($vars, EXTR_SKIP);
        ob_start();
        try {
            include $__file;
        } finally {
            unlink($__file);
        }
        return ob_get_clean();
    }

    public function includeView(string $view, array $vars): string
    {
        $file = $this->dir.'/'.str_replace('.', '/', $view).'.blade.php';
        return $this->execute($this->compile(file_get_contents($file)), $vars);
    }

    /** Mengambil ekspresi dalam tanda kurung seimbang yang dimulai pada posisi $pos. */
    private static function balanced(string $s, int $pos): array
    {
        $depth = 0; $start = $pos; $inStr = null;
        for ($i = $pos, $n = strlen($s); $i < $n; $i++) {
            $c = $s[$i];
            if ($inStr) { if ($c === $inStr && $s[$i-1] !== '\\') $inStr = null; continue; }
            if ($c === '"' || $c === "'") { $inStr = $c; continue; }
            if ($c === '(') $depth++;
            elseif ($c === ')') { $depth--; if ($depth === 0) return [substr($s, $start + 1, $i - $start - 1), $i + 1]; }
        }
        throw new RuntimeException('Kurung tidak seimbang');
    }

    public function compile(string $src): string
    {
        // Direktif dengan argumen dalam kurung
        $out = ''; $i = 0; $n = strlen($src); $stack = [];
        $withArgs = ['section', 'yield', 'include', 'foreach', 'forelse', 'if', 'elseif', 'method'];
        $plain = ['endsection' => null, 'endforeach' => '<?php endforeach; ?>', 'endif' => '<?php endif; ?>', 'else' => '<?php else: ?>',
            'empty' => '<?php endforeach; if ($__empty): ?>', 'endforelse' => '<?php endif; ?>',
            'csrf' => '<input type="hidden" name="_token" value="preview-token">'];
        while ($i < $n) {
            if ($src[$i] === '@' && preg_match('/\G@([a-zA-Z]+)/', $src, $m, 0, $i)) {
                $name = $m[1]; $after = $i + strlen($m[0]);
                if (in_array($name, $withArgs) && isset($src[$after]) && preg_match('/\G\s*\(/', $src, $sp, 0, $after)) {
                    [$expr, $next] = self::balanced($src, $after + strlen($sp[0]) - 1);
                    $out .= $this->directive($name, $expr, $stack);
                    $i = $next; continue;
                }
                if (array_key_exists($name, $plain)) {
                    if ($name === 'endsection') {
                        $sec = array_pop($stack);
                        $out .= "<?php \$__sections['$sec'] = ob_get_clean(); ?>";
                    } else {
                        $out .= $plain[$name];
                    }
                    $i = $after; continue;
                }
            }
            if (substr($src, $i, 3) === '{!!') {
                $end = strpos($src, '!!}', $i);
                $out .= '<?php echo '.trim(substr($src, $i + 3, $end - $i - 3)).'; ?>';
                $i = $end + 3; continue;
            }
            if (substr($src, $i, 2) === '{{') {
                $end = strpos($src, '}}', $i);
                $out .= '<?php echo e('.trim(substr($src, $i + 2, $end - $i - 2)).'); ?>';
                $i = $end + 2; continue;
            }
            $out .= $src[$i]; $i++;
        }
        return $out;
    }

    private function directive(string $name, string $expr, array &$stack): string
    {
        switch ($name) {
            case 'section':
                if (preg_match("/^'([^']+)'\s*,\s*(.+)$/s", $expr, $m)) {
                    return "<?php \$__sections['{$m[1]}'] = {$m[2]}; ?>";
                }
                $stack[] = trim($expr, "' ");
                return '<?php ob_start(); ?>';
            case 'yield':
                $parts = array_map('trim', explode(',', $expr, 2));
                $default = $parts[1] ?? "''";
                return "<?php echo \$__sections[{$parts[0]}] ?? {$default}; ?>";
            case 'include':
                $parts = preg_split('/,\s*(?=\[)/', $expr, 2);
                $data = $parts[1] ?? '[]';
                return "<?php echo \$__blade->includeView({$parts[0]}, array_merge(get_defined_vars(), {$data})); ?>";
            case 'foreach': return "<?php foreach ($expr): ?>";
            case 'forelse': return "<?php \$__empty = true; foreach ($expr): \$__empty = false; ?>";
            case 'if': return "<?php if ($expr): ?>";
            case 'elseif': return "<?php elseif ($expr): ?>";
            case 'method': return '<input type="hidden" name="_method" value='.$expr.'>';
        }
        return '';
    }
}

/* ---------- Helper tiruan Laravel ---------- */
function e($v): string { return htmlspecialchars((string) ($v ?? ''), ENT_QUOTES, 'UTF-8'); }
function asset(string $p): string { return '/'.ltrim($p, '/'); }

$GLOBALS['__routes'] = [
    'home' => '/', 'tentang' => '/tentang-kami', 'layanan' => '/layanan', 'portofolio' => '/portofolio',
    'portofolio.detail' => '/portofolio/{slug}', 'kontak' => '/kontak', 'kontak.kirim' => '/kontak',
    'admin.login' => '/admin/login', 'admin.login.post' => '/admin/login', 'admin.logout' => '/admin/logout', 'admin.dashboard' => '/admin',
    'admin.proyek.index' => '/admin/proyek', 'admin.proyek.create' => '/admin/proyek/create', 'admin.proyek.store' => '/admin/proyek',
    'admin.proyek.edit' => '/admin/proyek/{id}/edit', 'admin.proyek.update' => '/admin/proyek/{id}', 'admin.proyek.destroy' => '/admin/proyek/{id}',
    'admin.layanan.index' => '/admin/layanan', 'admin.layanan.create' => '/admin/layanan/create', 'admin.layanan.store' => '/admin/layanan',
    'admin.layanan.edit' => '/admin/layanan/{id}/edit', 'admin.layanan.update' => '/admin/layanan/{id}', 'admin.layanan.destroy' => '/admin/layanan/{id}',
    'admin.klien.index' => '/admin/klien', 'admin.klien.create' => '/admin/klien/create', 'admin.klien.store' => '/admin/klien',
    'admin.klien.edit' => '/admin/klien/{id}/edit', 'admin.klien.update' => '/admin/klien/{id}', 'admin.klien.destroy' => '/admin/klien/{id}',
    'admin.pesan.index' => '/admin/pesan', 'admin.pesan.baca' => '/admin/pesan/{id}/baca', 'admin.pesan.destroy' => '/admin/pesan/{id}',
    'admin.pengaturan.edit' => '/admin/pengaturan', 'admin.pengaturan.update' => '/admin/pengaturan',
];
function route(string $name, $params = []): string
{
    $path = $GLOBALS['__routes'][$name] ?? '/';
    if (! is_array($params)) { $params = [$params]; }
    if (preg_match('/\{(\w+)\}/', $path, $m)) {
        $val = $params[$m[1]] ?? array_shift($params);
        $path = str_replace($m[0], (string) $val, $path);
    } elseif ($params) {
        $path .= '?'.http_build_query($params);
    }
    return $path;
}
class PreviewRequest { public function is(string $pattern): bool {
    $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    $pattern = trim($pattern, '/');
    if ($pattern === '') return $uri === '';
    return (bool) preg_match('#^'.str_replace('\*', '.*', preg_quote($pattern, '#')).'$#', $uri);
} }
function request(): PreviewRequest { return new PreviewRequest(); }
function old(string $k, $default = null) { return $_GET['old_'.$k] ?? $default; }
function session(string $k) { return $_GET[$k] ?? null; }
class PreviewErrors { public function any(): bool { return false; } public function first(string $k): ?string { return $_GET['err_'.$k] ?? null; } }
