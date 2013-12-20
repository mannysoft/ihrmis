our standalone sdk only use on windows systems.

1, 32 bit windows xp

copy all sdk *.dll files to %windir%\system32 folder , and then run cmd.exe ,enter the following command:

    regsvr32.exe %windir%\system32\zkemkeeper.dll

if you want to unregister sdk , run cmd.exe ,enter the following command:

    regsvr32.exe -u %windir%\system32\zkemkeeper.dll

2, 64 bit windows xp

copy all sdk *.dll files to %windir%\sysWOW64 folder , and then run cmd.exe ,enter the following command:

    %windir%\syswow64\regsvr32.exe %windir%\syswow64\zkemkeeper.dll

if you want to unregister sdk , run cmd.exe ,enter the following command:

    %windir%\syswow64\regsvr32.exe -u %windir%\syswow64\zkemkeeper.dll

3, 32 bit windows Vista/win 7/server 2008

copy all sdk *.dll files to %windir%\system32 folder , and then run cmd.exe with administrator previledge ,
enter the following command:

    regsvr32.exe %windir%\system32\zkemkeeper.dll


if you want to unregister sdk , run cmd.exe with administrator previledge ,
enter the following command:

    %windir%\system32\regsvr32.exe -u %windir%\system32\zkemkeeper.dll

4, 64 bit windows Vista/win 7/server 2008

copy all sdk *.dll files to %windir%\sysWOW64 folder , and then run cmd.exe with administrator previledge ,
enter the following command:

    %windir%\syswow64\regsvr32.exe %windir%\syswow64\zkemkeeper.dll


if you want to unregister sdk , run cmd.exe with administrator previledge ,
enter the following command:

    %windir%\syswow64\regsvr32.exe -u %windir%\syswow64\zkemkeeper.dll
