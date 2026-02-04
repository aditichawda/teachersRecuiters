# GitHub Push Script
# इस script को run करने से पहले GitHub पर नया repository बना लें

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "GitHub Push Script" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Step 1: Directory check
$projectPath = "c:\xampp\htdocs\demo.teachersrecruiter.in"
Set-Location $projectPath
Write-Host "✓ Working directory: $projectPath" -ForegroundColor Green

# Step 2: Git initialization check
if (-not (Test-Path .git)) {
    Write-Host "Initializing Git repository..." -ForegroundColor Yellow
    git init
    Write-Host "✓ Git initialized" -ForegroundColor Green
} else {
    Write-Host "✓ Git repository already exists" -ForegroundColor Green
}

# Step 3: Git config check
Write-Host ""
Write-Host "Checking Git configuration..." -ForegroundColor Yellow
$userName = git config user.name
$userEmail = git config user.email

if (-not $userName) {
    Write-Host "⚠ Git user name not set!" -ForegroundColor Red
    $userName = Read-Host "Enter your Git user name"
    git config user.name $userName
    Write-Host "✓ User name set" -ForegroundColor Green
} else {
    Write-Host "✓ User name: $userName" -ForegroundColor Green
}

if (-not $userEmail) {
    Write-Host "⚠ Git user email not set!" -ForegroundColor Red
    $userEmail = Read-Host "Enter your Git email"
    git config user.email $userEmail
    Write-Host "✓ User email set" -ForegroundColor Green
} else {
    Write-Host "✓ User email: $userEmail" -ForegroundColor Green
}

# Step 4: Add files
Write-Host ""
Write-Host "Adding files to Git..." -ForegroundColor Yellow
git add .
Write-Host "✓ Files added" -ForegroundColor Green

# Step 5: Check if there are changes to commit
$status = git status --short
if ($status) {
    Write-Host ""
    Write-Host "Files to commit:" -ForegroundColor Yellow
    git status --short
    
    Write-Host ""
    $commitMessage = Read-Host "Enter commit message (or press Enter for default)"
    if (-not $commitMessage) {
        $commitMessage = "Post job button redirect and form UI improvements"
    }
    
    git commit -m $commitMessage
    Write-Host "✓ Changes committed" -ForegroundColor Green
} else {
    Write-Host "⚠ No changes to commit" -ForegroundColor Yellow
}

# Step 6: Remote repository setup
Write-Host ""
Write-Host "Remote repository setup..." -ForegroundColor Yellow
$remoteUrl = git remote get-url origin 2>$null

if (-not $remoteUrl) {
    Write-Host "⚠ No remote repository configured!" -ForegroundColor Red
    Write-Host ""
    Write-Host "Please create a new repository on GitHub first:" -ForegroundColor Yellow
    Write-Host "1. Go to https://github.com/new" -ForegroundColor White
    Write-Host "2. Create a new repository (empty, no README)" -ForegroundColor White
    Write-Host "3. Copy the repository URL" -ForegroundColor White
    Write-Host ""
    $newRemoteUrl = Read-Host "Enter your GitHub repository URL (e.g., https://github.com/username/repo.git)"
    
    if ($newRemoteUrl) {
        git remote add origin $newRemoteUrl
        Write-Host "✓ Remote repository added" -ForegroundColor Green
        $remoteUrl = $newRemoteUrl
    } else {
        Write-Host "⚠ No remote URL provided. Exiting..." -ForegroundColor Red
        exit
    }
} else {
    Write-Host "✓ Remote repository: $remoteUrl" -ForegroundColor Green
}

# Step 7: Branch setup
Write-Host ""
Write-Host "Setting up branch..." -ForegroundColor Yellow
$currentBranch = git branch --show-current
if (-not $currentBranch) {
    git branch -M main
    Write-Host "✓ Branch set to 'main'" -ForegroundColor Green
} else {
    Write-Host "✓ Current branch: $currentBranch" -ForegroundColor Green
}

# Step 8: Push to GitHub
Write-Host ""
Write-Host "Pushing to GitHub..." -ForegroundColor Yellow
Write-Host "Note: You may be asked for GitHub credentials" -ForegroundColor Cyan
Write-Host "Use your GitHub username and Personal Access Token (not password)" -ForegroundColor Cyan
Write-Host ""

try {
    git push -u origin main
    Write-Host ""
    Write-Host "========================================" -ForegroundColor Green
    Write-Host "✓ Successfully pushed to GitHub!" -ForegroundColor Green
    Write-Host "========================================" -ForegroundColor Green
} catch {
    Write-Host ""
    Write-Host "⚠ Error pushing to GitHub" -ForegroundColor Red
    Write-Host "Make sure you have:" -ForegroundColor Yellow
    Write-Host "1. Created repository on GitHub" -ForegroundColor White
    Write-Host "2. Correct repository URL" -ForegroundColor White
    Write-Host "3. GitHub Personal Access Token (not password)" -ForegroundColor White
    Write-Host ""
    Write-Host "You can also use GitHub Desktop for easier push:" -ForegroundColor Cyan
    Write-Host "https://desktop.github.com/" -ForegroundColor Cyan
}

Write-Host ""
Write-Host "Script completed!" -ForegroundColor Cyan
