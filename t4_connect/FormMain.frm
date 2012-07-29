VERSION 5.00
Object = "{F9043C88-F6F2-101A-A3C9-08002B2F49FB}#1.2#0"; "comdlg32.ocx"
Object = "{67397AA1-7FB1-11D0-B148-00A0C922E820}#6.0#0"; "MSADODC.OCX"
Object = "{FE9DED34-E159-408E-8490-B720A5E632C7}#6.0#0"; "zkemkeeper.dll"
Begin VB.Form frm1 
   Caption         =   "Sample program"
   ClientHeight    =   6930
   ClientLeft      =   60
   ClientTop       =   450
   ClientWidth     =   9030
   LinkTopic       =   "Form1"
   ScaleHeight     =   6930
   ScaleWidth      =   9030
   StartUpPosition =   3  'Windows Default
   Begin VB.CommandButton cmdOpen 
      Caption         =   "OpenFrm2"
      Height          =   375
      Left            =   2640
      TabIndex        =   57
      Top             =   4560
      Width           =   1815
   End
   Begin VB.CommandButton cmdGetLog 
      Caption         =   "Get Log"
      Height          =   345
      Left            =   5970
      TabIndex        =   56
      Top             =   1200
      Width           =   1035
   End
   Begin VB.CommandButton cmdSetUserInfo 
      Caption         =   "SetUserInfo"
      Height          =   285
      Left            =   2640
      TabIndex        =   55
      Top             =   3120
      Width           =   1785
   End
   Begin VB.TextBox textUserName 
      Height          =   285
      Left            =   960
      TabIndex        =   53
      Text            =   "John"
      Top             =   2550
      Width           =   1275
   End
   Begin VB.CommandButton cmdClearUserSMS 
      Caption         =   "Clear UserSMS"
      Height          =   285
      Left            =   7530
      TabIndex        =   52
      Top             =   6060
      Width           =   1395
   End
   Begin VB.CommandButton cmdClearSMS 
      Caption         =   "Clear SMS"
      Height          =   285
      Left            =   6480
      TabIndex        =   51
      Top             =   6060
      Width           =   1005
   End
   Begin VB.CommandButton cmdGetCardFun 
      Caption         =   "GetCardFun"
      Height          =   345
      Left            =   4710
      TabIndex        =   44
      Top             =   1200
      Width           =   1125
   End
   Begin VB.TextBox textStartTime 
      Height          =   345
      Left            =   5640
      TabIndex        =   43
      Top             =   5610
      Width           =   2025
   End
   Begin VB.TextBox textValidTime 
      Height          =   315
      Left            =   4470
      TabIndex        =   42
      Top             =   5610
      Width           =   945
   End
   Begin VB.TextBox textTag 
      Height          =   285
      Left            =   3360
      TabIndex        =   41
      Top             =   5610
      Width           =   1035
   End
   Begin VB.CommandButton cmdDeleteUserSMS 
      Caption         =   "DeleteUserSMS"
      Height          =   285
      Left            =   5160
      TabIndex        =   40
      Top             =   6060
      Width           =   1305
   End
   Begin VB.CommandButton cmdSetUserSMS 
      Caption         =   "SetUserSMS"
      Height          =   285
      Left            =   3840
      TabIndex        =   39
      Top             =   6060
      Width           =   1335
   End
   Begin VB.CommandButton cmdDeleteSMS 
      Caption         =   "DeleteSMS"
      Height          =   285
      Left            =   2520
      TabIndex        =   38
      Top             =   6060
      Width           =   1335
   End
   Begin VB.TextBox textEnrollNumber 
      Height          =   345
      Left            =   7830
      TabIndex        =   37
      Text            =   "347"
      Top             =   5640
      Width           =   975
   End
   Begin VB.CommandButton cmdSetSMS 
      Caption         =   "Set SMS"
      Height          =   285
      Left            =   1260
      TabIndex        =   36
      Top             =   6060
      Width           =   1275
   End
   Begin VB.TextBox textContent 
      Height          =   345
      Left            =   1320
      TabIndex        =   35
      Top             =   5610
      Width           =   1785
   End
   Begin VB.TextBox textID 
      Height          =   345
      Left            =   540
      TabIndex        =   34
      Text            =   "1"
      Top             =   5610
      Width           =   615
   End
   Begin VB.CommandButton cmdGetSMS 
      Caption         =   "Get SMS"
      Height          =   285
      Left            =   0
      TabIndex        =   33
      Top             =   6060
      Width           =   1275
   End
   Begin MSAdodcLib.Adodc adodc1 
      Height          =   375
      Left            =   4770
      Top             =   150
      Width           =   1875
      _ExtentX        =   3307
      _ExtentY        =   661
      ConnectMode     =   0
      CursorLocation  =   3
      IsolationLevel  =   -1
      ConnectionTimeout=   15
      CommandTimeout  =   30
      CursorType      =   3
      LockType        =   3
      CommandType     =   8
      CursorOptions   =   0
      CacheSize       =   50
      MaxRecords      =   0
      BOFAction       =   0
      EOFAction       =   0
      ConnectStringType=   1
      Appearance      =   1
      BackColor       =   -2147483643
      ForeColor       =   -2147483640
      Orientation     =   0
      Enabled         =   -1
      Connect         =   "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=D:\Prj\BioClock\zkemsdk\VB\CMI\FPData.mdb;Persist Security Info=False"
      OLEDBString     =   "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=D:\Prj\BioClock\zkemsdk\VB\CMI\FPData.mdb;Persist Security Info=False"
      OLEDBFile       =   ""
      DataSourceName  =   ""
      OtherAttributes =   ""
      UserName        =   ""
      Password        =   ""
      RecordSource    =   ""
      Caption         =   "adodc1"
      BeginProperty Font {0BE35203-8F91-11CE-9DE3-00AA004BB851} 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      _Version        =   393216
   End
   Begin VB.CommandButton cmdGetTime 
      Caption         =   "GetDeviceTime"
      Height          =   375
      Left            =   2640
      TabIndex        =   31
      Top             =   1440
      Width           =   1815
   End
   Begin MSComDlg.CommonDialog CommonDialog1 
      Left            =   7200
      Top             =   90
      _ExtentX        =   847
      _ExtentY        =   847
      _Version        =   393216
      CancelError     =   -1  'True
      DefaultExt      =   "cfg"
      DialogTitle     =   "Select The Firmware File"
      FileName        =   "emfw.cfg"
      Filter          =   "Firmware File|*.cfg"
   End
   Begin VB.TextBox txtEvent 
      Height          =   3615
      Left            =   4680
      MultiLine       =   -1  'True
      ScrollBars      =   3  'Both
      TabIndex        =   30
      Text            =   "FormMain.frx":0000
      Top             =   1680
      Width           =   4095
   End
   Begin VB.CommandButton cmdUpdateFirmware 
      Caption         =   "UpdateFirmware"
      Height          =   375
      Left            =   7200
      TabIndex        =   29
      Top             =   600
      Width           =   1575
   End
   Begin VB.CommandButton cmdGetUserTmpStr 
      Caption         =   "GetUserTmpStr"
      Height          =   375
      Left            =   7200
      TabIndex        =   28
      Top             =   1080
      Width           =   1575
   End
   Begin VB.CommandButton cmdConnect 
      Caption         =   "Connect"
      Height          =   375
      Left            =   2640
      TabIndex        =   27
      Top             =   240
      Width           =   1815
   End
   Begin VB.TextBox txtIP 
      Height          =   285
      Left            =   1080
      TabIndex        =   26
      Text            =   "192.168.0.2"
      Top             =   240
      Width           =   1335
   End
   Begin VB.CommandButton cmd1ToNMode 
      Caption         =   "Set 1:N Mode"
      Enabled         =   0   'False
      Height          =   255
      Left            =   2040
      TabIndex        =   24
      Top             =   5040
      Width           =   1815
   End
   Begin VB.CommandButton cmd1To1Mode 
      Caption         =   "Set 1:1 Mode"
      Enabled         =   0   'False
      Height          =   255
      Left            =   240
      TabIndex        =   23
      Top             =   5040
      Width           =   1815
   End
   Begin VB.CommandButton cmdThreshold 
      Caption         =   "Set Match Threshold"
      Enabled         =   0   'False
      Height          =   375
      Left            =   2640
      TabIndex        =   22
      Top             =   4200
      Width           =   1815
   End
   Begin VB.ComboBox cmbDateFormats 
      Height          =   315
      ItemData        =   "FormMain.frx":000C
      Left            =   180
      List            =   "FormMain.frx":002E
      Style           =   2  'Dropdown List
      TabIndex        =   20
      Top             =   3780
      Width           =   2055
   End
   Begin VB.CommandButton cmdDateFormat 
      Caption         =   "Change Date Format and Delimiter"
      Enabled         =   0   'False
      Height          =   495
      Left            =   2580
      TabIndex        =   19
      Top             =   3540
      Width           =   1815
   End
   Begin VB.CommandButton cmdSetUserTmpStr 
      Caption         =   "SetUserTmpStr"
      Enabled         =   0   'False
      Height          =   255
      Left            =   2640
      TabIndex        =   17
      Top             =   2760
      Width           =   1815
   End
   Begin VB.CommandButton cmdSetUserTmp 
      Caption         =   "SetUserTmp"
      Enabled         =   0   'False
      Height          =   255
      Left            =   2640
      TabIndex        =   18
      Top             =   2520
      Width           =   1815
   End
   Begin VB.CommandButton cmdSetEnrollStr 
      Caption         =   "SetEnrollDataStr"
      Enabled         =   0   'False
      Height          =   255
      Left            =   2640
      TabIndex        =   16
      Top             =   2280
      Width           =   1815
   End
   Begin VB.CommandButton cmdSetEnrollmentData 
      Caption         =   "SetEnrollData"
      Enabled         =   0   'False
      Height          =   255
      Left            =   2640
      TabIndex        =   14
      Top             =   2040
      Width           =   1815
   End
   Begin zkemkeeperCtl.CZKEM CZKEM1 
      Height          =   615
      Left            =   0
      OleObjectBlob   =   "FormMain.frx":0096
      TabIndex        =   12
      Top             =   0
      Visible         =   0   'False
      Width           =   615
   End
   Begin VB.TextBox txt1NThreshold 
      Height          =   285
      Left            =   240
      TabIndex        =   10
      Text            =   "34"
      Top             =   4440
      Width           =   735
   End
   Begin VB.TextBox txt11Threshold 
      Height          =   285
      Left            =   1320
      TabIndex        =   9
      Text            =   "18"
      Top             =   4440
      Width           =   735
   End
   Begin VB.TextBox txtUserID 
      Height          =   285
      Left            =   960
      TabIndex        =   8
      Text            =   "1"
      Top             =   2100
      Width           =   735
   End
   Begin VB.TextBox txtSecond 
      Height          =   285
      Left            =   1800
      TabIndex        =   6
      Text            =   "0"
      Top             =   1560
      Width           =   615
   End
   Begin VB.TextBox txtMinute 
      Height          =   285
      Left            =   1080
      TabIndex        =   5
      Text            =   "20"
      Top             =   1560
      Width           =   615
   End
   Begin VB.TextBox txtHour 
      Height          =   285
      Left            =   240
      TabIndex        =   4
      Text            =   "12"
      Top             =   1560
      Width           =   495
   End
   Begin VB.CommandButton cmdSetDeviceTime 
      Caption         =   "SetDeviceTime2"
      Enabled         =   0   'False
      Height          =   375
      Left            =   2640
      TabIndex        =   3
      Top             =   960
      Width           =   1815
   End
   Begin VB.TextBox txtDay 
      Height          =   285
      Left            =   1800
      TabIndex        =   2
      Text            =   "12"
      Top             =   960
      Width           =   615
   End
   Begin VB.TextBox txtMonth 
      Height          =   285
      Left            =   1080
      TabIndex        =   1
      Text            =   "2"
      Top             =   960
      Width           =   615
   End
   Begin VB.TextBox txtYear 
      Height          =   285
      Left            =   240
      TabIndex        =   0
      Text            =   "2005"
      Top             =   960
      Width           =   735
   End
   Begin VB.Label Label13 
      Caption         =   "User Name:"
      Height          =   255
      Left            =   60
      TabIndex        =   54
      Top             =   2550
      Width           =   915
   End
   Begin VB.Label Label12 
      Caption         =   "EnrollNumber"
      Height          =   225
      Left            =   7830
      TabIndex        =   50
      Top             =   5340
      Width           =   1185
   End
   Begin VB.Label Label11 
      Caption         =   "StartTime"
      Height          =   195
      Left            =   5670
      TabIndex        =   49
      Top             =   5340
      Width           =   1575
   End
   Begin VB.Label Label10 
      Caption         =   "ValidMinutes"
      Height          =   255
      Left            =   4650
      TabIndex        =   48
      Top             =   5370
      Width           =   825
   End
   Begin VB.Label Label9 
      Caption         =   "SMSTag"
      Height          =   225
      Left            =   3390
      TabIndex        =   47
      Top             =   5340
      Width           =   1155
   End
   Begin VB.Label Label8 
      Caption         =   "SMS content"
      Height          =   225
      Left            =   1290
      TabIndex        =   46
      Top             =   5310
      Width           =   1785
   End
   Begin VB.Label Label7 
      Caption         =   "SMSID"
      Height          =   255
      Left            =   540
      TabIndex        =   45
      Top             =   5340
      Width           =   615
   End
   Begin VB.Label Label6 
      Caption         =   "Label6"
      Height          =   255
      Left            =   4710
      TabIndex        =   32
      Top             =   780
      Width           =   1335
   End
   Begin VB.Label Label5 
      Caption         =   "1:N threshold   1:1 threshold"
      Height          =   255
      Left            =   240
      TabIndex        =   25
      Top             =   4200
      Width           =   2295
   End
   Begin VB.Label Label4 
      Caption         =   "Date Format and Delimiter"
      Height          =   255
      Left            =   180
      TabIndex        =   21
      Top             =   3540
      Width           =   2295
   End
   Begin VB.Label Label3 
      Caption         =   "User ID:"
      Height          =   255
      Left            =   240
      TabIndex        =   15
      Top             =   2100
      Width           =   735
   End
   Begin VB.Label lblInfo 
      Caption         =   "Information"
      Height          =   255
      Left            =   0
      TabIndex        =   13
      Top             =   6600
      Width           =   4815
   End
   Begin VB.Label Label2 
      Caption         =   "Hour           Minute     Second"
      Height          =   255
      Left            =   240
      TabIndex        =   11
      Top             =   1320
      Width           =   2295
   End
   Begin VB.Label Label1 
      Caption         =   "Year            Month      Day"
      Height          =   255
      Left            =   240
      TabIndex        =   7
      Top             =   720
      Width           =   2295
   End
End
Attribute VB_Name = "frm1"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Option Explicit
'Updates to the SDK need to address:
'
'   Function for setting date time - 'SetDeviceTime2'
'
'    Fix for 'SetEnrollmentData' returning ¡°ERR_INVALID_PARAM¡±
'    Programming samples with sample function arguments to verify performance of these three functions:
'            SetEnrollDataStr
'            SetUserTmp,
'            SetUserTmpStr
'
'    Documentation on SLog records.
'
'    How to change the Date Delimiter using the SetDeviceInfo command
'
'    How to program the "Match Threshold" value in the clock
'
'    How to program the clock for 1:1 or 1:x biometrics
'
'    How to program the 1:1 threshold value
'
'    How to program the date time display format on the clock to Month, Day, Year (U.S. format)

Const sSampleTemplate1 = "A1CA1E81AF384F2118ACBA4B4026A7BD48D434AB2540800D56A645D414513760BC09463A58A30F53AB500060302C4E713F3926507C260DAE7982092DA45B40151D3974910940864DFC04038D7152080BA565D40E20B66902083E8E69F8057E3564940AAF0F62B8040811312408DD954D780A72AC5B01122CB347400A31AC3892114794370004688B4E340677053180126A0572910484375BBC0DB63AB4EA131011C35D6069A3FEBA9A99C0C26181A4EFFDA8B897C0C265A586CDEDD9A9A80BC269A466BBEEDBB80B81C267A5789CDEEBDA890EC365A589BDFECDB899C363A187BD7303A2DDCA89C3608162687102A2EFCA99C35EA1789D6F030D15A1BA8AC358825C690716A1E9B922C354A177684E26A24B8898C34CA177563F34A2197787C445A4664568667731C442A46539AC647737C440A4636EF965563BC53E3D414BA2E354653FC5434B5BA393345545C65DA3D6314655E0"
Const sSampleTemplate2 = "A1CA1482AF114AA1464C134C00234712629418392B5C0008539B5454094A2B40BC165F2256E30A4F1C37003DCF9739F114C91A5EBC07B6264482106411470031549C4D510F54A02AFC2E09A51E1223942C5D5409C3955B42093C314FB808CE0E4E544727222EB8129053040413B914670C1011C6465248C0C5575C616713C0C353A18EDD72182027C0C24DA2A9DEBB27272A28C0C249A18ACD554937333433C0C243A289DF91413E3B3DC0C142A1569F52A2931478C0C1403A352C695EA2131468C0C13D332310016A5BA1034545C0C2170F09016B5DA1133445C0C20C0A090264A122434CC0C20C090803675EA15364C0C308050170635E5958C0C403017469625DE2CC47434040CC484640E0"
Const sSampleTemplate3 = "A1CA0F819B3A3FE11431BB3CC0143EAD46D40A48B56DC00A24C151540A9E4245BC12A1403FE32D1DB8580008ADB23A310745216CFC1277AA59C2124CBE35401154C13BD14E441F4EFC095C2B35920D5125D44B1A1011C03735C03B3DC03B40C03A3FC46269C174A1AB9BC03B3DC362A38B8CFCBC0AC0C455A1E8BA636DA1FECE0EC458A278ACBF72040B1114C458A2578CDF70040F1618C352A29967AD606E04141A1BC34EA2A587AA586A07181D1DC350A3756687B41D1D2122C350A36445678129222324C352A5450438730198C3514F4940A31386324A25C355524C3E33A3166355FBC3595B543428A3478446FBC46162102082A1456EE0"
Const sSampleTemplate4 = "A1CA1A82982C456107C4AF3CC00FC93046D415CD3E51400CD84154140DDC1C58BC1D369B332305CFA96D00144A9E4E712D4F236CFC0E3F2472C20A33A554000EC0A350D114523731FC0DD833689209D54160140CE1BE18420BE5331DF80ED73B481405D9A71C3808C9154DE41DE71E18380558922F0103CF0A41C00BDD11249207CBAF64800AC853F46614AEC06B1D1011C556575F6E7709C0C453585B636F740819C0C353A1ABDF6D7508181C21C0C24FA1BBBC626A750D1C212326C0C251A1AAAC5F69021521A1E9AAC152A2899BAC66051F28A1B889C151A289A99B5C2CA26C9678C151A298999A514035A186552BC151A6A7A88820145326C152A6B7978754351105C154A4A98769765444392D287E4755A4B9A6697776504126237E455BA4B87878876A5D68131A7E4463A2977677825F656F060FC16BA4867556879B69710105C171A6774658688BEDDBC176A667366A678ADBA9C277A56277A6889BA9E0"


Const sSampleTemplate = _
        "A1CA168293AF5A613A3A2F5DC02B343C591413BCBE54C01FBA3E49143CB33F4BFC59C" + _
        "03E56E31C613158801244316B710B35BD5F3C0D51A866C2261A3C6E400B46B7375109" + _
        "44AC41FC0D4EA043521460245C940C6CAD5C827E25AE5978424CBE79140A44C144B83" + _
        "E9DA36BA40D10456138115B3A44EB16B2D40F121011E3C863646C7273C0C767A28CFB" + _
        "CAC0C664A2D9ECAC03C0C561A39BBEEBCB0CC0C560A179BE7177050D1318C456A1B8A" + _
        "C646F030F171C20C454A1988B5C6A141D232627C450814F504E3E2AA189A8C44DA365" + _
        "77520682C448A4566867576635C447A4228CB9756539C53F3436414AA2874367C52E1" + _
        "70C655B52A1253540C605036D6054A11545E0"

Dim vMachineNumber
Dim bConnected As Boolean
'Public connFP As New ADODB.Connection
'Public recFP As New ADODB.Recordset
'Set rs_gBlood = HisConn.Execute(StrSqlQueryCondition)
Function Str2Byte(s As String, Index As Integer) As Byte
    Dim b1 As Byte, b2 As Byte
    Dim s1 As String, s2 As String
    
    s1 = Mid(s, Index * 2 + 1, 1)
    s2 = Mid(s, Index * 2 + 2, 1)
    If s1 >= "A" Then
        b1 = Asc(s1) - Asc("A") + 10
    Else
        b1 = Asc(s1) - Asc("0")
    End If
    If s2 >= "A" Then
        b2 = Asc(s2) - Asc("A") + 10
    Else
        b2 = Asc(s2) - Asc("0")
    End If
    Str2Byte = b1 * 16 + b2
End Function

Function Str2ByteArray(s As String, b() As Byte) As Integer
    Dim i As Integer
    Dim l As Integer
    l = Len(s) / 2
    For i = 0 To l - 1 Step 1
        b(i) = Str2Byte(s, i)
    Next
    Str2ByteArray = l
End Function

Function Str2LongArray(s As String, ldata() As Long) As Integer
    Dim i As Integer
    Dim lbyte As Integer, llong As Integer, l As Long
    Dim b(1024 * 4) As Byte
    lbyte = Str2ByteArray(s, b)
    llong = lbyte / 4
    If llong * 4 < lbyte Then llong = llong + 1
    For i = 0 To llong - 1 Step 1
        l = b(i * 4 + 3)
        If l > 127 Then
            l = (((l - 128) * 256 + b(i * 4 + 2)) * 256 + b(i * 4 + 1)) * 256 + b(i * 4)
            l = l - 2147483647
            l = l - 1
        Else
            l = ((l * 256 + b(i * 4 + 2)) * 256 + b(i * 4 + 1)) * 256 + b(i * 4)
        End If
        ldata(i) = l
    Next
    Str2LongArray = llong
End Function

Private Sub cmd1To1Mode_Click()
    If CZKEM1.SetDeviceInfo(vMachineNumber, 35, 1) Then
        lblInfo.Caption = "Set 1:1 Mode OK"
    Else
        lblInfo.Caption = "Set 1:1 Mode Fail"
    End If
End Sub

Private Sub cmd1ToNMode_Click()
    If CZKEM1.SetDeviceInfo(vMachineNumber, 35, 0) Then
        lblInfo.Caption = "Set 1:N Mode OK"
    Else
        lblInfo.Caption = "Set 1:N Mode Fail"
    End If

End Sub

Sub ShowButtonState()
    cmdSetDeviceTime.Enabled = bConnected
    cmdThreshold.Enabled = bConnected
    cmdSetEnrollmentData.Enabled = bConnected
    cmdSetEnrollStr.Enabled = bConnected
    cmdSetUserTmp.Enabled = bConnected
    cmdSetUserTmpStr.Enabled = bConnected
    cmdDateFormat.Enabled = bConnected
    cmd1To1Mode.Enabled = bConnected
    cmd1ToNMode.Enabled = bConnected
    cmdUpdateFirmware.Enabled = bConnected
    cmdGetUserTmpStr.Enabled = bConnected
End Sub

Private Sub cmdClearSMS_Click()
    If CZKEM1.ClearSMS(vMachineNumber) Then
        lblInfo.Caption = "ClearSMS OK"
    Else
        lblInfo.Caption = "ClearSMS fail"
    End If
End Sub

Private Sub cmdClearUserSMS_Click()
    If CZKEM1.ClearUserSMS(vMachineNumber) Then
        lblInfo.Caption = "ClearUserSMS OK"
    Else
        lblInfo.Caption = "ClearUserSMS fail"
    End If
End Sub

Private Sub cmdConnect_Click()
    Dim ver As String
    If bConnected Then
        CZKEM1.Disconnect
    Else
        If CZKEM1.Connect_Net(txtIP.Text, 4370) Then
            If CZKEM1.GetFirmwareVersion(vMachineNumber, ver) Then
                lblInfo.Caption = "Version=""" & ver & """"
                If CZKEM1.GetDeviceIP(vMachineNumber, ver) Then
                    lblInfo.Caption = lblInfo.Caption & ", IP=" & ver
                End If
            End If
        Else
            Beep
            lblInfo.Caption = "Connect fail."
        End If
    End If
End Sub

Private Sub cmdDateFormat_Click()
    If CZKEM1.SetDeviceInfo(vMachineNumber, 34, cmbDateFormats.ListIndex) Then
        lblInfo.Caption = "Set Date Format OK"
    Else
        lblInfo.Caption = "Set Date Format Fail"
    End If
End Sub

Private Sub cmdDeleteSMS_Click()
    Dim b As Boolean
    If CZKEM1.DeleteSMS(vMachineNumber, Val(textID.Text)) Then
        lblInfo.Caption = "DeleteSMS OK"
    Else
        lblInfo.Caption = "DeleteSMS fail"
    End If
End Sub

Private Sub cmdDeleteUserSMS_Click()
    Dim b As Boolean
    If CZKEM1.DeleteUserSMS(vMachineNumber, Val(textEnrollNumber.Text), Val(textID.Text)) Then
        lblInfo.Caption = "DeleteUserSMS OK"
    Else
        lblInfo.Caption = "DeleteUserSMS fail"
    End If
End Sub

Private Sub cmdGetCardFun_Click()
    Dim CardFun As Long
    If CZKEM1.GetCardFun(vMachineNumber, CardFun) Then
        MsgBox CStr(CardFun)
    End If
End Sub

Private Sub cmdGetSMS_Click()
    Dim Tag As Long
    Dim ValidMinutes As Long
    Dim StartTime As String
    Dim Content As String
    If CZKEM1.GetSMS(vMachineNumber, Val(textID.Text), Tag, ValidMinutes, StartTime, Content) Then
        textContent.Text = Content
        textTag.Text = Tag
        textValidTime.Text = ValidMinutes
        textStartTime.Text = StartTime
        lblInfo.Caption = "GetSMS OK"
    Else
        lblInfo.Caption = "GetSMS Fail"
    End If
    
End Sub

Private Sub cmdGetTime_Click()
   Dim iYear As Long, iMonth As Long, iDay As Long, iHour As Long, iMinute As Long, iSecond As Long
   
   If CZKEM1.GetDeviceTime(vMachineNumber, iYear, iMonth, iDay, iHour, iMinute, iSecond) Then
        lblInfo.Caption = "Device Time is " & iYear & "-" & iMonth & "-" & iDay & " " & iHour & ":" & iMinute & ":" & iSecond
   Else
        lblInfo.Caption = "GetDeviceTime fail"
   End If
End Sub

Private Sub cmdGetUserSMS_Click()

End Sub

Private Sub cmdGetUserTmpStr_Click()
    Dim iEnrollNumber, iBackupNumber
    Dim sTmpData As String
    Dim TmpLength As Long
    iEnrollNumber = CLng(txtUserID.Text)
    iBackupNumber = 0
    If CZKEM1.GetUserTmpStr(vMachineNumber, iEnrollNumber, iBackupNumber, sTmpData, TmpLength) Then
        lblInfo.Caption = "GetUserTmpStr OK"
        recFP.Open "select * from fptable", connFP, adOpenKeyset, adLockOptimistic
        recFP.AddNew
        recFP.Fields("EnrollNumber") = iEnrollNumber
        recFP.Fields("FingerNumber") = iBackupNumber
        recFP.Fields("Template") = sTmpData
        recFP.Update
        recFP.Close
        MsgBox sTmpData, , "Template" & iBackupNumber & " of " & iEnrollNumber
        
    Else
        lblInfo.Caption = "GetUserTmpStr Fail"
    End If
End Sub

Private Sub cmdOpen_Click()
    'frm2.Show
End Sub

Private Sub cmdSetDeviceTime_Click()
    Dim iYear, iMonth, iDay, iHour, iMinute, iSecond
    iYear = CLng(txtYear.Text)
    iMonth = CLng(txtMonth.Text)
    iDay = CLng(txtDay.Text)
    iHour = CLng(txtHour.Text)
    iMinute = CLng(txtMinute.Text)
    iSecond = CLng(txtSecond.Text)
    If Not CZKEM1.SetDeviceTime2(vMachineNumber, iYear, iMonth, iDay, iHour, iMinute, iSecond) Then
        lblInfo.Caption = "SetDeviceTime2 fail"
    Else
        lblInfo.Caption = "SetDeviceTime2 OK"
    End If
End Sub

Private Sub cmdSetEnrollmentData_Click()
    Dim iEnrollNumber, iEMachineNumber, iBackupNumber, iPrivilege, iPassword
    Dim iEnrollData(1024) As Long
    iEnrollNumber = CLng(txtUserID.Text)
    iEMachineNumber = 1
    iBackupNumber = 0
    iPrivilege = 0
    iPassword = 0
    Str2LongArray sSampleTemplate, iEnrollData
    If CZKEM1.SetEnrollData(vMachineNumber, iEnrollNumber, iEMachineNumber, iBackupNumber, iPrivilege, iEnrollData(0), iPassword) Then
        lblInfo.Caption = "SetEnrollData OK"
    Else
        lblInfo.Caption = "SetEnrollData fail"
    End If
End Sub

Private Sub cmdSetEnrollStr_Click()
    Dim iEnrollNumber, iEMachineNumber, iBackupNumber, iPrivilege, iPassword
    Dim sEnrollData
    iEnrollNumber = CLng(txtUserID.Text)
    iEMachineNumber = 1
    iBackupNumber = 1
    iPrivilege = 0
    iPassword = 0
    sEnrollData = sSampleTemplate1
    If CZKEM1.SetEnrollDataStr(vMachineNumber, iEnrollNumber, iEMachineNumber, iBackupNumber, iPrivilege, sEnrollData, iPassword) Then
        lblInfo.Caption = "SetEnrollDataStr OK"
    Else
        lblInfo.Caption = "SetEnrollDataStr fail"
    End If
End Sub

Private Sub cmdSetSMS_Click()
    Dim SMSID
    Dim SmsTag
    Dim ValidMinutes
    Dim StartTime
    Dim Content
    Dim b
    SMSID = Val(textID.Text)
    Content = textContent.Text
    SmsTag = Val(textTag.Text)
    ValidMinutes = Val(textValidTime.Text)
    StartTime = textStartTime.Text
    If CZKEM1.SetSMS(vMachineNumber, SMSID, SmsTag, ValidMinutes, StartTime, Content) Then
        lblInfo.Caption = "Set SMS OK"
    Else
        lblInfo.Caption = "Set SMS fail"
    End If
End Sub

Private Sub cmdSetUserInfo_Click()
    Dim iEnrollNumber
    Dim bEnrollData(1024) As Byte
    iEnrollNumber = CLng(txtUserID.Text)
    If CZKEM1.SetUserInfo(vMachineNumber, iEnrollNumber, textUserName.Text, "", 0, True) Then
        lblInfo.Caption = "SetUserInfo OK"
    Else
        lblInfo.Caption = "SetUserInfo fail"
    End If
End Sub

Private Sub cmdSetUserSMS_Click()
    Dim b
    If CZKEM1.SetUserSMS(vMachineNumber, Val(textEnrollNumber.Text), Val(textID.Text)) Then
        lblInfo.Caption = "SetUserSMS OK"
    Else
        lblInfo.Caption = "SetUserSMS fail"
    End If
    
End Sub

Private Sub cmdSetUserTmp_Click()
    Dim iEnrollNumber, iEMachineNumber, iBackupNumber
    Dim bEnrollData(1024) As Byte
    iEnrollNumber = CLng(txtUserID.Text)
    iEMachineNumber = 1
    iBackupNumber = 2
    Str2ByteArray sSampleTemplate2, bEnrollData
    If CZKEM1.SetUserTmp(vMachineNumber, iEnrollNumber, iBackupNumber, bEnrollData(0)) Then
        lblInfo.Caption = "SetUserTmp OK"
    Else
        lblInfo.Caption = "SetUserTmp fail"
    End If
End Sub

Private Sub cmdSetUserTmpStr_Click()
    Dim iEnrollNumber, iEMachineNumber, iBackupNumber
    Dim sEnrollData
    iEnrollNumber = CLng(txtUserID.Text)
    iEMachineNumber = 1
    iBackupNumber = 3
    sEnrollData = sSampleTemplate3
    If CZKEM1.SetUserTmpStr(vMachineNumber, iEnrollNumber, iBackupNumber, sEnrollData) Then
        lblInfo.Caption = "SetUserTmpStr OK"
    Else
        lblInfo.Caption = "SetUserTmpStr fail"
    End If
End Sub


Private Sub cmdThreshold_Click()
    If CZKEM1.SetDeviceInfo(vMachineNumber, 23, CLng(txt1NThreshold.Text)) Then
        lblInfo.Caption = "Set 1:N Threshold OK"
    Else
        lblInfo.Caption = "Set 1:N Threshold Fail"
    End If
    If CZKEM1.SetDeviceInfo(vMachineNumber, 25, CLng(txt11Threshold.Text)) Then
        lblInfo.Caption = "Set 1:1 Threshold OK"
    Else
        lblInfo.Caption = "Set 1:1 Threshold Fail"
    End If
End Sub

Private Sub cmdUpdateFirmware_Click()
    Dim sFile
    On Error GoTo cancelline
    CommonDialog1.ShowOpen
    
    sFile = CommonDialog1.FileName
    'Disbale device to speed up firmware transfer
    CZKEM1.DisableDeviceWithTimeOut vMachineNumber, 10
    If CZKEM1.UpdateFirmware(sFile) Then
        lblInfo.Caption = "Update Firmware success."
    Else
        lblInfo.Caption = "Update Firmware fail."
    End If
cancelline:
End Sub

Private Sub Command1_Click()
    Dim CardFun As Long
    CZKEM1.GetCardFun vMachineNumber, CardFun
    MsgBox CStr(CardFun)
End Sub

Private Sub Command2_Click()

End Sub

Private Sub CZKEM1_OnAttTransaction(ByVal EnrollNumber As Long, ByVal IsInValid As Long, _
    ByVal AttState As Long, ByVal VerifyMethod As Long, ByVal Year As Long, ByVal Month As Long, _
    ByVal Day As Long, ByVal Hour As Long, ByVal Minute As Long, ByVal Second As Long)
    txtEvent.Text = "OnAttTransaction(" & EnrollNumber & "," & _
        IsInValid & "," & AttState & "," & VerifyMethod & _
        "," & Year & "-" & Month & "-" & Day & " " & Hour & ":" & Minute & ":" & Second & Chr(13) & Chr(10) & txtEvent.Text
        Debug.Print "Year" & Year
        Debug.Print "Month" & Month
        Debug.Print "Day" & Day
        Debug.Print "Hour" & Hour
        Debug.Print "Minute" & Minute
        Debug.Print "Second" & Second
End Sub

Private Sub CZKEM1_OnConnected()
    txtEvent.Text = "OnConnected" & Chr(13) & Chr(10) & txtEvent.Text
    bConnected = True
    cmdConnect.Caption = "Disconnect"
    lblInfo.Caption = "Connected to device."
    ShowButtonState
End Sub

Private Sub CZKEM1_OnDisConnected()
    txtEvent.Text = "OnDisConnected" & Chr(13) & Chr(10) & txtEvent.Text
    bConnected = False
    cmdConnect.Caption = "Connect"
    lblInfo.Caption = "Disconnected from device."
    ShowButtonState
End Sub

'Private Sub CZKEM1_OnEnrollFinger(ByVal EnrollNumber As Long, ByVal FingerIndex As Long)
'    txtEvent.Text = "OnEnrollFinger(" & EnrollNumber & "," & FingerIndex & ")" & Chr(13) & Chr(10) & txtEvent.Text
'End Sub

Private Sub CZKEM1_OnFinger()
    txtEvent.Text = "OnFinger" & Chr(13) & Chr(10) & txtEvent.Text
End Sub

Private Sub CZKEM1_OnFingerFeature(ByVal Score As Long)
    txtEvent.Text = "OnFingerFeature(" & Score & ")" & Chr(13) & Chr(10) & txtEvent.Text
End Sub


Private Sub CZKEM1_OnHIDNum(ByVal CardNumber As Long)
    MsgBox CStr(CardNumber)
End Sub

Private Sub CZKEM1_OnKeyPress(ByVal Key As Long)
    txtEvent.Text = "OnKeyPress(" & Key & ")" & Chr(13) & Chr(10) & txtEvent.Text
End Sub

Private Sub CZKEM1_OnNewUser(ByVal EnrollNumber As Long)
    txtEvent.Text = "OnNewUser(" & EnrollNumber & ")" & Chr(13) & Chr(10) & txtEvent.Text
End Sub

Private Sub CZKEM1_OnVerify(ByVal UserID As Long)
    txtEvent.Text = "OnVerify(" & UserID & ")" & Chr(13) & Chr(10) & txtEvent.Text
End Sub

Private Sub Form_Load()
    Dim s As String
    cmbDateFormats.ListIndex = 0
    bConnected = False
    ShowButtonState
    CZKEM1.BASE64 = 0
    vMachineNumber = 1
    'connFP.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & "FPdata.MDB;Persist Security Info=False"
    CZKEM1.GetSDKVersion s
    Label6.Caption = s
End Sub
