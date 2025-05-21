# Development Decisions and Processes

This document tracks important decisions, processes, and workflows that have been established for the theme development. This serves as a historical record and reference for future development sessions.

## Table of Contents

- [Version Control](#version-control)
- [Documentation](#documentation)
- [Development Workflow](#development-workflow)
- [Site Management](#site-management)
- [Security](#security)

## Version Control

### Repository Structure
- Created new repository at `https://github.com/davelawrence/ptr-wordpress-theme.git`
- Using GPL-2.0 license for WordPress compatibility
- Implemented structured commit messages and PR templates
- Established `.gitignore` for WordPress theme development

### Commit Message Format
```
<type>: <subject>

<body>
```
Types:
- `feat`: New feature
- `fix`: Bug fix
- `refactor`: Code refactoring
- `style`: Formatting changes
- `doc`: Documentation updates
- `test`: Test-related changes
- `chore`: Maintenance tasks

## Documentation

### Documentation Structure
- All documentation stored in `/docs` directory
- Each process gets its own Markdown file
- README.md serves as documentation index
- Documentation standards established for consistency

### Documentation Standards
- Use Markdown format
- Include table of contents
- Provide clear examples
- Keep information up to date
- Link to related documentation

## Development Workflow

### PR Process
- Use provided PR template
- Include testing instructions
- Document WordPress compatibility
- Note browser compatibility
- Consider performance impact
- Address security considerations

### Testing Requirements
- Test on multiple WordPress versions
- Verify browser compatibility
- Check mobile responsiveness
- Document testing steps

## Site Management

### Site Restore Process
- Use `sync-check.sh` script for verification
- Follow documented restore process
- Create GitHub issues for incidents
- Maintain backup of modified files

### Backup Strategy
- Regular theme backups
- Version control for all files
- Documentation of customizations
- Regular restore testing

## Security

### Best Practices
- Keep WordPress core updated
- Regular theme updates
- Secure file permissions
- No sensitive data in repository

## Adding New Decisions

When documenting new decisions or processes:

1. Add a new section if needed
2. Include:
   - Date of decision
   - Context/reasoning
   - Implementation details
   - Any alternatives considered
3. Update table of contents
4. Link to related documentation

## Maintenance

This document should be:
- Updated when new processes are established
- Reviewed periodically for accuracy
- Referenced when making related decisions
- Used to maintain consistency across development sessions 