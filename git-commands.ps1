# Git Commands Script - Popup Issue Fix
# यह script full path use करती है, popup issue नहीं आएगी

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "Git Setup - Using Full Path" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

$gitPath = "C:\Program Files\Git\cmd\git.exe"
$projectPath = "c:\xampp\htdocs\demo.teachersrecruiter.in"

# Change to project directory
Set-Location $projectPath
Write-Host "✓ Working directory: $projectPath" -ForegroundColor Green
Write-Host ""

# Check Git config
Write-Host "Checking Git configuration..." -ForegroundColor Yellow
$userName = & $gitPath config user.name
$userEmail = & $gitPath config user.email

if ($userName) {
    Write-Host "✓ User name: $userName" -ForegroundColor Green
} else {
    Write-Host "⚠ User name not set" -ForegroundColor Yellow
    $newName = Read-Host "Enter your name"
    & $gitPath config --global user.name $newName
}

if ($userEmail) {
    Write-Host "✓ User email: $userEmail" -ForegroundColor Green
} else {
    Write-Host "⚠ User email not set" -ForegroundColor Yellow
    $newEmail = Read-Host "Enter your email"
    & $gitPath config --global user.email $newEmail
}

Write-Host ""

# Initialize Git
if (-not (Test-Path .git)) {
    Write-Host "Initializing Git repository..." -ForegroundColor Yellow
    & $gitPath init
    Write-Host "✓ Git initialized" -ForegroundColor Green
} else {
    Write-Host "✓ Git repository already exists" -ForegroundColor Green
}

Write-Host ""

# Add files
Write-Host "Adding files..." -ForegroundColor Yellow
& $gitPath add .
Write-Host "✓ Files added" -ForegroundColor Green

Write-Host ""

# Check status
Write-Host "Current status:" -ForegroundColor Yellow
& $gitPath status --short

Write-Host ""

# Commit
$commitMessage = Read-Host "Enter commit message (or press Enter for default)"
if (-not $commitMessage) {
    $commitMessage = "Post job button redirect and form UI improvements"
}

& $gitPath commit -m $commitMessage
Write-Host "✓ Changes committed" -ForegroundColor Green

Write-Host ""

# Remote setup
$remoteUrl = & $gitPath remote get-url origin 2>$null

if (-not $remoteUrl) {
    Write-Host "⚠ No remote repository configured!" -ForegroundColor Yellow
    Write-Host ""
    Write-Host "Please create a new repository on GitHub first:" -ForegroundColor Cyan
    Write-Host "1. Go to https://github.com/new" -ForegroundColor White
    Write-Host "2. Create a new repository (empty, no README)" -ForegroundColor White
    Write-Host "3. Copy the repository URL" -ForegroundColor White
    Write-Host ""
    $newRemoteUrl = Read-Host "Enter your GitHub repository URL"
    
    if ($newRemoteUrl) {
        & $gitPath remote add origin $newRemoteUrl
        Write-Host "✓ Remote repository added" -ForegroundColor Green
        $remoteUrl = $newRemoteUrl
    } else {
        Write-Host "⚠ No remote URL provided. Exiting..." -ForegroundColor Red
        exit
    }
} else {
    Write-Host "✓ Remote repository: $remoteUrl" -ForegroundColor Green
}

Write-Host ""

# Branch setup
Write-Host "Setting branch to main..." -ForegroundColor Yellow
& $gitPath branch -M main
Write-Host "✓ Branch set to main" -ForegroundColor Green

Write-Host ""

# Push
Write-Host "Pushing to GitHub..." -ForegroundColor Yellow
Write-Host "Note: You will be asked for GitHub credentials" -ForegroundColor Cyan
Write-Host "Use your GitHub username and Personal Access Token" -ForegroundColor Cyan
Write-Host ""

try {
    & $gitPath push -u origin main
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
    Write-Host "3. GitHub Personal Access Token" -ForegroundColor White
}

Write-Host ""
Write-Host "Script completed!" -ForegroundColor Cyan
Write-Host ""
Read-Host "Press Enter to exit"
