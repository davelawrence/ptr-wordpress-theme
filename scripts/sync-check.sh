#!/bin/bash

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${YELLOW}Starting WordPress Theme Sync Check...${NC}\n"

# Get the current date for the backup
DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="backups/theme_${DATE}"

# Create backup directory if it doesn't exist
mkdir -p $BACKUP_DIR

# Function to check if a file exists in the live site
check_live_file() {
    local file=$1
    if [ -f "$file" ]; then
        echo -e "${GREEN}✓${NC} $file exists"
        return 0
    else
        echo -e "${RED}✗${NC} $file is missing"
        return 1
    fi
}

# Function to compare files
compare_files() {
    local file=$1
    if [ -f "$file" ]; then
        if git diff --quiet "$file"; then
            echo -e "${GREEN}✓${NC} $file matches repository"
        else
            echo -e "${RED}✗${NC} $file differs from repository"
            # Create backup of the file
            cp "$file" "$BACKUP_DIR/$(basename "$file")"
            echo "  Backup created at $BACKUP_DIR/$(basename "$file")"
        fi
    fi
}

# Check essential theme files
echo -e "\n${YELLOW}Checking essential theme files...${NC}"
essential_files=(
    "style.css"
    "functions.php"
    "index.php"
    "header.php"
    "footer.php"
)

for file in "${essential_files[@]}"; do
    check_live_file "$file"
done

# Check for modified files
echo -e "\n${YELLOW}Checking for modified files...${NC}"
git status --porcelain | while read -r line; do
    if [[ $line =~ ^[[:space:]]*M[[:space:]]+(.*) ]]; then
        file="${BASH_REMATCH[1]}"
        compare_files "$file"
    fi
done

# Check for untracked files
echo -e "\n${YELLOW}Checking for untracked files...${NC}"
git ls-files --others --exclude-standard | while read -r file; do
    echo -e "${YELLOW}!${NC} $file is not tracked in git"
    # Create backup of the file
    cp "$file" "$BACKUP_DIR/$(basename "$file")"
    echo "  Backup created at $BACKUP_DIR/$(basename "$file")"
done

echo -e "\n${YELLOW}Sync check complete.${NC}"
echo -e "Backups of modified/untracked files are stored in: ${GREEN}$BACKUP_DIR${NC}"
echo -e "\nNext steps:"
echo -e "1. Review the differences above"
echo -e "2. Check the backup directory for any files that need to be committed"
echo -e "3. Run 'git add' for any new files that should be tracked"
echo -e "4. Commit changes with a descriptive message"
echo -e "5. Push changes to GitHub" 