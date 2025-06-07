import os
import re

def remove_php_comments(content):
    # Remove single-line comments starting with //
    content = re.sub(r'//.*?$', '', content, flags=re.MULTILINE)
    
    # Remove single-line comments starting with #
    content = re.sub(r'#.*?$', '', content, flags=re.MULTILINE)
    
    # Remove multi-line comments /* ... */
    content = re.sub(r'/\*.*?\*/', '', content, flags=re.DOTALL)
    
    # Remove empty lines that were left after comment removal
    lines = content.split('\n')
    cleaned_lines = []
    for line in lines:
        stripped = line.strip()
        if stripped or (cleaned_lines and cleaned_lines[-1].strip()):
            cleaned_lines.append(line)
    
    return '\n'.join(cleaned_lines)

def process_php_files(directory):
    processed_count = 0
    
    for root, dirs, files in os.walk(directory):
        for file in files:
            if file.endswith('.php') and file != 'remove_comments.py':
                filepath = os.path.join(root, file)
                try:
                    with open(filepath, 'r', encoding='utf-8', errors='ignore') as f:
                        original_content = f.read()
                    
                    cleaned_content = remove_php_comments(original_content)
                    
                    if cleaned_content != original_content:
                        with open(filepath, 'w', encoding='utf-8') as f:
                            f.write(cleaned_content)
                        print(f"Processed: {filepath}")
                        processed_count += 1
                    
                except Exception as e:
                    print(f"Error processing {filepath}: {e}")
    
    print(f"\nTotal files processed: {processed_count}")

if __name__ == "__main__":
    current_dir = os.getcwd()
    print(f"Processing PHP files in: {current_dir}")
    process_php_files(current_dir)
    print("Comment removal completed!")
