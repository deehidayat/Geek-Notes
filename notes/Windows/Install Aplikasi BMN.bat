@echo off
cls
echo ####################################################
echo #############  INSTALASI APLIKASI BMN  #############
echo #############  deehieday@yahoo.co.id   #############
echo ####################################################

set xamppfolder=c:\xampp
set dbuser=root
set namaweb=yiibmn
set go=y

echo. 
set /p namaweb=Masukkan nama web [%namaweb%]: 
set /p xamppfolder=Masukkan lokasi XAMPP[%xamppfolder%]: 
set /p dbuser=Masukkan username untuk database [%dbuser%]:

echo. 
set /p go=Mulai instalasi [y/n]:
if %go%==y goto :mulai
goto :end

:mulai
if not exist %xamppfolder%\htdocs\ goto :notxampp

if exist %xamppfolder%\htdocs\yiibmn\ goto :adafolder
echo. 
echo Membuat Folder %xamppfolder%\htdocs\%namaweb%
md %xamppfolder%\htdocs\%namaweb%
goto :copyapp

:adafolder
echo. 
echo Folder tujuan tidak kosong, timpa folder 
goto :copyapp

:copyapp
if not exist yiibmn goto :end
echo. 
echo Copy Folder
xcopy yiibmn %xamppfolder%\htdocs\%namaweb% /e
goto :installdb

:installdb
if not exist %xamppfolder%\mysql\bin\mysql.exe goto :notxampp
echo. 
echo Instalasi Database, Masukkan Password MySQL
%xamppfolder%\mysql\bin\mysql -u%dbuser% -p < %xamppfolder%\htdocs\%namaweb%\dee\yii_bmn.sql
goto :success

:success
start "" "http://localhost/%namaweb%"
echo. 
echo Instalasi selesai, gunakan http://localhost/%namaweb% 
echo untuk mengakses aplikasi dari browser anda.
goto :end

:notxampp
echo XAMPP tidak ada 
goto :end

:end
echo. 
echo Instalasi selesai tekan tombol untuk keluar
pause > nul