@echo off

npm run build
IF ERRORLEVEL 1 (
    ECHO ASSETS BUILD FAILED!
    exit /b 1
)

ECHO ASSETS BUILD!

docker build -t nojram/bookhaven .
IF ERRORLEVEL 1 (
    ECHO DOCKER BUILD FAILED!
    exit /b 1
)

ECHO DOCKER IMAGE CREATED!

ECHO RUNNING DOCKER IMAGE...

docker run -p 8000:8000 -d nojram/bookhaven

ECHO -e DOCKER IMAGE RUNNING
