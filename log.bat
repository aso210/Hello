@echo off
adb devices
echo clean log...
adb logcat -c
adb logcat -c
set filename=%1
if "%filename%"=="" set filename=log
echo logfile name=%filename%.txt
echo del log\%filename%.txt ...
del E:\log\%filename%.txt
echo loging...
adb logcat -v time>E:\log\%filename%.txt