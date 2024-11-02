@echo off

set current_dir=%~dp0


set exe_file=%current_dir%Final EXE\login.exe


if exist "%exe_file%" (
    start "" "%exe_file%"
) else (
    echo Dosya bulunamadı: %exe_file%
)
