@ECHO OFF
set errmsg="Missing_Files!"
if exist "%1msreadersetup.exe" GOTO error2

if not exist "msr1" set errmsg=%errmsg%+"msr1"
copy /b /v "msr1" "%1msreadersetup.exe"

if not exist "msr2" set errmsg=%errmsg%+"msr2"
copy /b /v "%1msreadersetup.exe"+"msr2" "%1msreadersetup.exe"

if not exist "msr3" set errmsg=%errmsg%+"msr3"
copy /b /v "%1msreadersetup.exe"+"msr3" "%1msreadersetup.exe"

if not exist "msr4" set errmsg=%errmsg%+"msr4"
copy /b /v "%1msreadersetup.exe"+"msr4" "%1msreadersetup.exe"

if not exist "msr5" set errmsg=%errmsg%+"msr5"
copy /b /v "%1msreadersetup.exe"+"msr5" "%1msreadersetup.exe"

if not exist "msr6" set errmsg=%errmsg%+"msr6"
copy /b /v "%1msreadersetup.exe"+"msr6" "%1msreadersetup.exe"

if not exist "msr7" set errmsg=%errmsg%+"msr7"
copy /b /v "%1msreadersetup.exe"+"msr7" "%1msreadersetup.exe"

if %errmsg% == "Missing_Files!" GOTO good
ECHO %errmsg%
if exist "%1msreadersetup.exe" erase "%1msreadersetup.exe"
GOTO notfound
:good
ECHO Done, msreadersetup.exe restored.
GOTO end
:error
ECHO No file specified.
GOTO end
:error2
ECHO File msreadersetup.exe Already Exists.
GOTO end
:notfound
ECHO File(s) Missing. Restore ABORTED! 
GOTO end
:end
ECHO ON
