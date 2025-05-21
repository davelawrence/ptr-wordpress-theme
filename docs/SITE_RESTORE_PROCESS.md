# WordPress Theme Site Restore Process

This document outlines the process to follow when a site crashes and gets restored from a backup, ensuring our repository stays in sync with the live site.

## Prerequisites

- Local copy of the theme repository
- Access to the restored site files
- Git installed locally
- Basic knowledge of Git commands

## Process Overview

1. [Download Restored Files](#1-download-restored-files)
2. [Run Sync Check](#2-run-sync-check)
3. [Update Repository](#3-update-repository)
4. [Document Incident](#4-document-incident)

## 1. Download Restored Files

After your web host restores the site from a backup:

1. Download the restored theme files from your web host
2. Place them in your local repository directory, replacing the existing files
3. Make sure to preserve the `.git` directory and other repository-specific files

## 2. Run Sync Check

We have a script that helps identify differences between the restored site and our repository:

```bash
# Make sure you're in the theme directory
cd path/to/theme

# Run the sync check script
./scripts/sync-check.sh
```

The script will:
- Check if all essential files exist
- Compare files with the repository
- Create backups of any modified or untracked files
- Show you what needs to be updated

## 3. Update Repository

After reviewing the sync check results:

```bash
# 1. Review the differences
git status

# 2. Add any new files that should be tracked
git add <new-files>

# 3. Commit the changes with a descriptive message
git commit -m "fix: Sync with restored site version"

# 4. Push to GitHub
git push
```

## 4. Document Incident

Create a new issue in GitHub with the following information:

1. **Title**: "Site Restore: [Date] - [Brief Description]"
2. **Description**:
   - When the crash occurred
   - What was restored
   - What changes were made to sync the repository
   - Any lessons learned
3. **Labels**: Add appropriate labels (e.g., `site-restore`, `maintenance`)
4. **Assignees**: Assign to relevant team members

## Troubleshooting

### Common Issues

1. **Missing Files**
   - Check if files were properly restored by the host
   - Verify file permissions
   - Ensure no files were accidentally excluded

2. **Git Conflicts**
   - If you encounter conflicts, review the differences carefully
   - Use `git diff` to examine specific changes
   - Consider creating a new branch for complex syncs

3. **Untracked Files**
   - Review each untracked file
   - Determine if it should be added to the repository
   - Update `.gitignore` if necessary

## Prevention

To minimize the impact of future crashes:

1. Regular backups
2. Version control for all theme files
3. Documentation of all customizations
4. Regular testing of the restore process

## Support

If you encounter any issues during this process:
1. Check this documentation
2. Review the GitHub issues for similar situations
3. Contact the development team

## Related Resources

- [GitHub Repository](https://github.com/davelawrence/ptr-wordpress-theme)
- [WordPress Theme Handbook](https://developer.wordpress.org/themes/)
- [Git Documentation](https://git-scm.com/doc) 