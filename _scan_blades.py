import os
import re
root = os.path.join(os.getcwd(), 'resources', 'views')
for dirpath, dirnames, filenames in os.walk(root):
    for fn in filenames:
        if fn.endswith('.blade.php'):
            path = os.path.join(dirpath, fn)
            with open(path, encoding='utf-8', errors='ignore') as f:
                text = f.read()
            for m in re.finditer(r'@\w+\(', text):
                i = m.end()
                depth = 1
                while i < len(text) and depth > 0:
                    if text[i] == '(': depth += 1
                    elif text[i] == ')': depth -= 1
                    i += 1
                if depth != 0:
                    start_line = text[:m.start()].count('\n') + 1
                    print(f'Unclosed directive in {path} at line {start_line}: {text[m.start():m.end()+40].splitlines()[0]}')
