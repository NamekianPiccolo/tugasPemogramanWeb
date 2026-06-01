<?php
$dir = __DIR__ . '/app/Views/admin';
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

$count = 0;
foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $path = $file->getRealPath();
        $content = file_get_contents($path);
        
        // Match gsap.from( TARGET, { y: NUM, opacity: 0, OTHER_VARS } )
        $pattern = '/gsap\.from\(\s*(\[[^\]]+\]|\'[^\']+\'|"[^"]+"|m\.firstElementChild|\.[a-zA-Z0-9_-]+)\s*,\s*\{\s*y\s*:\s*(-?\d+)\s*,\s*opacity\s*:\s*0\s*,\s*(.*?)\s*\}\s*\);/s';
        
        $newContent = preg_replace_callback($pattern, function($matches) {
            $target = $matches[1];
            $y = $matches[2];
            $otherVars = $matches[3];
            return "gsap.fromTo($target, { y: $y, opacity: 0 }, { y: 0, opacity: 1, $otherVars });";
        }, $content);
        
        if ($newContent !== $content) {
            file_put_contents($path, $newContent);
            $count++;
            echo "Updated: $path\n";
        }
    }
}
echo "Total files updated: $count\n";
