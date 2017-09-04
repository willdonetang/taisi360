@echo off
del list.txt
for /f "delims=" %%a in ('dir .\test /b/a-d') do echo %%a >>list.txt
pause