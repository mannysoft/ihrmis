VERSION 5.00
Object = "{831FDD16-0C5C-11D2-A9FC-0000F8754DA1}#2.0#0"; "MSCOMCTL.OCX"
Object = "{FE9DED34-E159-408E-8490-B720A5E632C7}#6.0#0"; "zkemkeeper.dll"
Begin VB.Form frm2 
   Caption         =   "Demo"
   ClientHeight    =   7365
   ClientLeft      =   60
   ClientTop       =   345
   ClientWidth     =   11565
   LinkTopic       =   "Form1"
   MaxButton       =   0   'False
   ScaleHeight     =   7365
   ScaleWidth      =   11565
   StartUpPosition =   3  'Windows Default
   Begin zkemkeeperCtl.CZKEM CZKEM1 
      Height          =   855
      Left            =   120
      OleObjectBlob   =   "Formx.frx":0000
      TabIndex        =   54
      Top             =   240
      Width           =   495
   End
   Begin VB.CommandButton cmdRestore 
      Caption         =   "RestoreData"
      Height          =   375
      Left            =   120
      TabIndex        =   53
      Top             =   6240
      Width           =   1455
   End
   Begin VB.CommandButton cmdBackUp 
      Caption         =   "BackUpData"
      Height          =   375
      Left            =   120
      TabIndex        =   52
      Top             =   5880
      Width           =   1455
   End
   Begin VB.CommandButton cmdDelSmUser 
      Caption         =   "DelSomeUser"
      Height          =   375
      Left            =   120
      TabIndex        =   51
      Top             =   5520
      Width           =   1455
   End
   Begin VB.CommandButton cmdWriteByDB 
      Caption         =   "WriteTmpFromDB"
      Height          =   375
      Left            =   120
      TabIndex        =   50
      Top             =   5160
      Width           =   1455
   End
   Begin VB.CommandButton Command2 
      Caption         =   "CreateSomeUser"
      Height          =   375
      Left            =   120
      TabIndex        =   49
      Top             =   4800
      Width           =   1455
   End
   Begin VB.CommandButton cmdAccessCtl 
      Caption         =   "AccessControl"
      Height          =   375
      Left            =   120
      TabIndex        =   48
      Top             =   4440
      Width           =   1455
   End
   Begin VB.CommandButton cmdSetDevice 
      Caption         =   "Set/GetDevice"
      Height          =   375
      Left            =   120
      TabIndex        =   47
      Top             =   4080
      Width           =   1455
   End
   Begin VB.CommandButton cmdDown 
      Caption         =   "DLUserInfoToDB"
      Height          =   495
      Left            =   120
      TabIndex        =   46
      ToolTipText     =   "Down load all user infromation to db contain finger templata"
      Top             =   3600
      Width           =   1455
   End
   Begin VB.Frame frmDeleteUser 
      Caption         =   "Delete a User "
      Height          =   1455
      Left            =   1680
      TabIndex        =   41
      Top             =   5040
      Width           =   2535
      Begin VB.CommandButton CmdDeleteUser 
         Caption         =   "Delete"
         Height          =   375
         Left            =   600
         TabIndex        =   43
         Top             =   960
         Width           =   1095
      End
      Begin VB.TextBox txtDeleteUser 
         Height          =   375
         Left            =   840
         TabIndex        =   42
         Top             =   360
         Width           =   1575
      End
      Begin VB.Label Label1 
         Caption         =   "User ID"
         Height          =   375
         Left            =   120
         TabIndex        =   44
         Top             =   360
         Width           =   615
      End
   End
   Begin VB.CommandButton cmdDelAUser 
      Caption         =   "Delete a user"
      Height          =   495
      Left            =   120
      TabIndex        =   40
      Top             =   3120
      Width           =   1455
   End
   Begin VB.CommandButton cmdGetUserInfo 
      Caption         =   "Getalluserinfo"
      Height          =   495
      Left            =   120
      TabIndex        =   39
      Top             =   2640
      Width           =   1455
   End
   Begin VB.CommandButton Command1 
      Caption         =   "DownLoad "
      Height          =   495
      Left            =   120
      TabIndex        =   38
      Top             =   2160
      Width           =   1455
   End
   Begin VB.Frame frmDel 
      Caption         =   "Delate user finger template"
      Height          =   1335
      Left            =   6360
      TabIndex        =   33
      Top             =   1440
      Width           =   2895
      Begin VB.CommandButton cmdcan 
         Caption         =   "Cancel"
         Height          =   255
         Left            =   1680
         TabIndex        =   37
         Top             =   960
         Width           =   1095
      End
      Begin VB.CommandButton cmdDel 
         Caption         =   "Delete"
         Height          =   255
         Left            =   120
         TabIndex        =   36
         Top             =   960
         Width           =   1095
      End
      Begin VB.TextBox txtId 
         Height          =   375
         Left            =   840
         TabIndex        =   34
         Text            =   "1"
         Top             =   360
         Width           =   1815
      End
      Begin VB.Label labID 
         Caption         =   "User ID"
         Height          =   375
         Left            =   120
         TabIndex        =   35
         Top             =   480
         Width           =   855
      End
   End
   Begin VB.CommandButton cmdDelUser 
      Caption         =   "Deletefingertemp"
      Height          =   495
      Left            =   120
      TabIndex        =   32
      Top             =   1680
      Width           =   1455
   End
   Begin VB.Frame frmCrtuser 
      Caption         =   "UserInfo"
      Height          =   3615
      Left            =   1680
      TabIndex        =   17
      Top             =   1440
      Width           =   4695
      Begin VB.ComboBox cmdPri 
         CausesValidation=   0   'False
         Height          =   315
         IMEMode         =   2  'OFF
         Left            =   1440
         TabIndex        =   31
         Text            =   "0"
         Top             =   2280
         Width           =   2895
      End
      Begin VB.TextBox txtMacNum 
         Height          =   285
         Left            =   1440
         TabIndex        =   30
         Text            =   "1"
         Top             =   360
         Width           =   2895
      End
      Begin VB.CommandButton cmdCancel 
         Caption         =   "Cancel"
         Height          =   255
         Left            =   3000
         TabIndex        =   28
         Top             =   3240
         Width           =   1335
      End
      Begin VB.CommandButton cmdCreate 
         Caption         =   "Create"
         Height          =   255
         Left            =   240
         TabIndex        =   27
         Top             =   3240
         Width           =   1335
      End
      Begin VB.ComboBox cmbEnable 
         CausesValidation=   0   'False
         Height          =   315
         IMEMode         =   2  'OFF
         Left            =   1440
         TabIndex        =   26
         Text            =   "True"
         Top             =   2760
         Width           =   2895
      End
      Begin VB.TextBox txtPaw 
         Height          =   285
         Left            =   1440
         TabIndex        =   25
         Top             =   1800
         Width           =   2895
      End
      Begin VB.TextBox txtName 
         Height          =   285
         Left            =   1440
         TabIndex        =   24
         Top             =   1320
         Width           =   2895
      End
      Begin VB.TextBox txtEnrollNum 
         Height          =   285
         Left            =   1440
         TabIndex        =   23
         Text            =   "1"
         Top             =   840
         Width           =   2895
      End
      Begin VB.Label labMacNum 
         Caption         =   "MachineNumber"
         Height          =   375
         Left            =   120
         TabIndex        =   29
         Top             =   360
         Width           =   1335
      End
      Begin VB.Label labEnble 
         Caption         =   "Enabled"
         Height          =   375
         Left            =   120
         TabIndex        =   22
         Top             =   2760
         Width           =   855
      End
      Begin VB.Label labPri 
         Caption         =   "Privilege"
         Height          =   375
         Left            =   120
         TabIndex        =   21
         Top             =   2280
         Width           =   735
      End
      Begin VB.Label labPaw 
         Caption         =   "Password"
         Height          =   495
         Left            =   120
         TabIndex        =   20
         Top             =   1800
         Width           =   735
      End
      Begin VB.Label labName 
         Caption         =   "Name"
         Height          =   255
         Left            =   120
         TabIndex        =   19
         Top             =   1320
         Width           =   735
      End
      Begin VB.Label labEnrollNum 
         Caption         =   "EnrollNumber"
         Height          =   375
         Left            =   120
         TabIndex        =   18
         Top             =   840
         Width           =   1335
      End
   End
   Begin VB.CommandButton cmdCreateUser 
      Caption         =   "Create a user"
      Height          =   495
      Left            =   120
      TabIndex        =   16
      Top             =   1200
      Width           =   1455
   End
   Begin MSComctlLib.ListView lvX 
      Height          =   5535
      Left            =   1680
      TabIndex        =   15
      Top             =   1320
      Width           =   9855
      _ExtentX        =   17383
      _ExtentY        =   9763
      View            =   3
      LabelWrap       =   -1  'True
      HideSelection   =   -1  'True
      _Version        =   393217
      ForeColor       =   -2147483640
      BackColor       =   -2147483643
      BorderStyle     =   1
      Appearance      =   1
      NumItems        =   0
   End
   Begin MSComctlLib.StatusBar StatusBar1 
      Align           =   2  'Align Bottom
      Height          =   495
      Left            =   0
      TabIndex        =   14
      Top             =   6870
      Width           =   11565
      _ExtentX        =   20399
      _ExtentY        =   873
      _Version        =   393216
      BeginProperty Panels {8E3867A5-8586-11D1-B16A-00C0F0283628} 
         NumPanels       =   1
         BeginProperty Panel1 {8E3867AB-8586-11D1-B16A-00C0F0283628} 
            Object.Width           =   3528
            MinWidth        =   3528
         EndProperty
      EndProperty
   End
   Begin VB.CommandButton cmdConnect 
      Caption         =   "Connect"
      Height          =   375
      Left            =   9720
      TabIndex        =   13
      Top             =   720
      Width           =   1815
   End
   Begin VB.TextBox txtRate 
      Height          =   375
      Left            =   7320
      TabIndex        =   12
      Text            =   "115200"
      Top             =   600
      Width           =   2175
   End
   Begin VB.TextBox txtMachNum 
      Height          =   375
      Left            =   5400
      TabIndex        =   10
      Text            =   "1"
      Top             =   600
      Width           =   1095
   End
   Begin VB.TextBox txtComNum 
      Height          =   375
      Left            =   3240
      TabIndex        =   8
      Text            =   "1"
      Top             =   600
      Width           =   495
   End
   Begin VB.TextBox txtPort 
      Height          =   405
      Left            =   6960
      TabIndex        =   6
      Text            =   "4370"
      Top             =   120
      Width           =   2535
   End
   Begin VB.TextBox txtIP 
      Height          =   375
      Left            =   3240
      TabIndex        =   4
      Text            =   "192.168.0.2"
      Top             =   120
      Width           =   2655
   End
   Begin VB.OptionButton optCom 
      Caption         =   "ComConnect"
      Height          =   255
      Left            =   720
      TabIndex        =   2
      Top             =   720
      Width           =   1335
   End
   Begin VB.OptionButton optNetconncet 
      Caption         =   "NetConnect"
      Height          =   375
      Left            =   720
      TabIndex        =   1
      Top             =   120
      Width           =   1215
   End
   Begin VB.Label labFirmV 
      Height          =   255
      Left            =   9600
      TabIndex        =   0
      Top             =   360
      Width           =   1935
   End
   Begin VB.Label labSDK 
      Height          =   255
      Left            =   9720
      TabIndex        =   45
      Top             =   0
      Width           =   1695
   End
   Begin VB.Label labRare 
      Caption         =   "Rate"
      Height          =   255
      Left            =   6720
      TabIndex        =   11
      Top             =   720
      Width           =   495
   End
   Begin VB.Label labMachNum 
      Caption         =   "MachineNumber"
      Height          =   375
      Left            =   3840
      TabIndex        =   9
      Top             =   720
      Width           =   1335
   End
   Begin VB.Label labCom 
      Caption         =   "ComNumber"
      Height          =   255
      Left            =   2160
      TabIndex        =   7
      Top             =   720
      Width           =   975
   End
   Begin VB.Label labPort 
      Caption         =   "port"
      Height          =   255
      Left            =   6240
      TabIndex        =   5
      Top             =   240
      Width           =   375
   End
   Begin VB.Label labIP 
      Caption         =   "IP"
      Height          =   255
      Left            =   2160
      TabIndex        =   3
      Top             =   240
      Width           =   255
   End
End
Attribute VB_Name = "frm2"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
'**********************************************
'Time:2005-6-10                               *
'purpose:Demo                                 *
'author:YongHong Pei,work for zksoftware      *
'contact:pyhppp@hotmail.com                   *
'**********************************************
'follow code get access testing by zkemsdk 5.10.90

Private Sub cmdAccessCtl_Click()
    frm4.Show
End Sub

Private Sub cmdBackUp_Click()
    Dim dataFile
    Dim bflag As Boolean
    
    dataFile = "c:\AAA"
    
    bflag = CZKEM1.BackupData(dataFile)
    
    If bflag Then
        MsgBox "You are right", vbOKOnly + vbInformation, "Info"
    Else
        MsgBox "fail", vbOKOnly + vbInformation, "Info"
    End If
End Sub

Private Sub cmdcan_Click()
    frmDel.Visible = False
End Sub

Private Sub cmdCancel_Click()
    frmCrtuser.Visible = False
End Sub

Private Sub cmdConnect_Click()
    Dim bconn As Boolean
    Dim mint As Integer
    Dim SDKVersion As String
    Dim strVersion As String

    CZKEM1.BASE64 = 1
    bconn = False
    CZKEM1.GetSDKVersion SDKVersion
    labSDK.Caption = "SDKVersion:" + SDKVersion
    
    If cmdConnect.Caption = "DisConnect" Then
        CZKEM1.Beep 150
        DoEvents
        CZKEM1.Disconnect
        
        cmdConnect.Caption = "Connect"
        StatusBar1.Panels(1).Text = "DisConnect"
        Exit Sub
    End If
    
    If optNetconncet.Value = True Then
        If txtPort.Text = "" Then Exit Sub
        bconn = CZKEM1.Connect_Net(CStr(txtIP.Text), CLng(txtPort.Text))
        If bconn Then
            cmdConnect.Caption = "DisConnect"
            StatusBar1.Panels(1).Text = "connect successful"
            CZKEM1.Beep 150
            CZKEM1.GetFirmwareVersion CInt(txtMacNum.Text), strVersion
            labFirmV.Caption = strVersion
        Else
            StatusBar1.Panels(1).Text = "connect fail"
        End If
    End If
    
    If optCom.Value = True Then
        CZKEM1.BASE64 = 1
        bconn = CZKEM1.Connect_Com(CLng(txtComNum.Text), CLng(txtMachNum.Text), CLng(txtRate.Text))
        If bconn Then
            cmdConnect.Caption = "DisConnect"
            StatusBar1.Panels(1).Text = "connect successful"
            CZKEM1.Beep 150
            CZKEM1.GetFirmwareVersion CInt(txtMacNum.Text), strVersion
            labFirmV.Caption = strVersion
        Else
            StatusBar1.Panels(1).Text = "connect fail"
        End If
    End If
End Sub

Private Sub cmdCreate_Click()
    Dim bCrtUser As Boolean
    Dim tmpData As String
    Dim xx
    Dim Size As Long
    
    'You can get finger template from db or other.
    xx = "mspZ1oh6jjlOwQu4PU5BGcG/TsEZxkU0ARUiSS9BEB2yS0FBSbJNQVJFLVpBFiO+ckEHODlWAQxKyEgBG2s8a4EIQEw+wRaBhzGBCecHaEEKhAtggQEEv1uBDU0YV0EHBiFzAQkhxV1BDEwVbYEJhgNoAQYSHFTBCHupUgEQd5QugQxrsiZBC0W7GAEMRakbQQhYLyEBCVADXQEHhEFUrBPQpHERARJXV1hVVVdeZ3MJFR0kJicmJysBElRTU09OUVVeaRUiJyorKikqLQISWVtZW15lbnYGDhcfIyQkJSgBElFQTkpHSEtPSTMvMDAwLS0tMAISXV9eX2NqcXYFCxIZHSAiJCYB"
    CZKEM1.FPTempConvertStr xx, tmpData, Size
     xx = tmpData
    'tmpData = "YYpGKDBSCkQMILFbhoggotJy4CFfgGaoE8MKV6cfgg5cgdfvF3CDjqf1OgsIRJsM7whGTOVcDEDw3JoMLRS4gQwxQuULCDZ4sQYMXhZ9OwgaLJnUCAZcXIYIIc0ooAhnlzmkCC9JBdwIONMg1QxJ/jzTDB3+JWwMEiiY0DA6fhG8SWqjxCxEV4sMAo6zLqrvAwnWkusy6u7rAwXClu8y8u7upwMFtpb3NzMu6qcB+ZqW8zuzdyqkewH5ipcve/+7KqCDAfl1gY2dvAAoToeypIYHAflihub9zCxih6rkjgcB+U6GXnGgTHaLrmHclwH5QoXZ2QCijTKp2aMB+TaF2QjUro125RljAfktLSUQ7MCkoM6LmJUbAfktLSUQ5LCMgRKKhA0bAfkyBRzwoGg1hUUahBDXAwVBPTUgaEANoWVBGQDo4wMFUVFZddgZ3amGhERLA"
    
    bCrtUser = CZKEM1.SetUserInfo(CInt(txtMacNum.Text), CLng(txtEnrollNum.Text), CStr(txtName.Text), CStr(txtPaw.Text), CInt(cmdPri.Text), CBool(cmbEnable.Text))
    If bCrtUser Then
        bCrtUser = CZKEM1.SetUserTmpStr(CInt(txtMacNum.Text), CLng(txtEnrollNum.Text), 0, xx)
        If bCrtUser Then
            StatusBar1.Panels(1).Text = "Create a user successful"
            frmCrtuser.Visible = False
        Else
            StatusBar1.Panels(1).Text = "Create a user fail"
        End If
    End If
End Sub

Private Sub cmdCreateUser_Click()
    frmCrtuser.Visible = True
End Sub

Private Sub cmdDel_Click()
    Dim bdel As Boolean
    
    bdel = CZKEM1.DelUserTmp(CInt(txtComNum.Text), CInt(txtId.Text), 0)
    If bdel Then
        StatusBar1.Panels(1).Text = "Del user FP successful"
    Else
        StatusBar1.Panels(1).Text = "Del user FP fail"
    End If
End Sub

Private Sub cmdDelAUser_Click()
    frmDeleteUser.Visible = True
End Sub

Private Sub CmdDeleteUser_Click()
    Dim Bd As Boolean
    
    If txtDeleteUser.Text = "" Then Exit Sub
    CZKEM1.DelUserTmp CInt(txtMachNum.Text), CLng(txtDeleteUser.Text), 0
    Bd = CZKEM1.DeleteEnrollData(CInt(txtMachNum.Text), CLng(txtDeleteUser.Text), CInt(txtMachNum.Text), 0)
    If Bd Then
        StatusBar1.Panels(1).Text = "Del a user successful"
        frmDeleteUser.Visible = False
    Else
        StatusBar1.Panels(1).Text = "Del a user fail"
        frmDeleteUser.Visible = False
    End If
End Sub

Private Sub cmdDelSmUser_Click()
    Dim i As Long
    Dim strtempsql As String
    
    strtempsql = "select EnrollNumber,Template from fptable"
    recFP.Open strtempsql, connFP, adOpenKeyset, adLockOptimistic, -1
    recFP.MoveFirst
    'del 50 user
    While Not recFP.EOF
      CZKEM1.DelUserTmp CInt(txtMachNum.Text), CLng(recFP!EnrollNumber), 0
      Bd = CZKEM1.DeleteEnrollData(CInt(txtMachNum.Text), CLng(recFP!EnrollNumber), CInt(txtMachNum.Text), 0)
      recFP.MoveNext
      i = i + 1
      If i > 50 Then
        MsgBox "done"
        Exit Sub
      End If
    Wend
End Sub

Private Sub cmdDelUser_Click()
    frmDel.Visible = True
End Sub

Private Sub cmdDown_Click()
    Dim dwEnrollNmber As Long
    Dim dwEnrollNumber1
    Dim name As String
    Dim passWord As String
    Dim privilege As Integer
    Dim Enabled As Boolean
    Dim tmpData As String
    Dim TmpLength As Integer
    Dim sqlstr As String
    Dim TmpData1
    Dim k As Long
    
    'Down load all user information to database,contain finger templata
    'with SqlServer,you could use ntext type,
    If CZKEM1.ReadAllUserID(CInt(txtMachNum.Text)) Then
        CZKEM1.ReadAllTemplate CLng(frm2.txtMachNum.Text)
        While CZKEM1.GetAllUserInfo(CLng(txtMachNum.Text), dwEnrollNmber, name, passWord, privilege, Enabled)
            If name = "" Then
                name = "Null"
'            Else
'                name = Mid(name, 1, Len(name) - 3)
            End If
            If passWord = "" Then
                passWord = "Null"
            End If
            dwEnrollNumber1 = dwEnrollNmber
            'with variable of TmpLength,you could see How long template is.
            For k = 0 To 9
                CZKEM1.GetUserTmpStr CLng(txtMachNum.Text), dwEnrollNumber1, CLng(k), tmpData, TmpLength
                If Trim(tmpData) <> "" And Len(tmpData) > 200 Then
                  'if you want to down load all,you can insert  it into db and then updata it.At here.
                   Exit For
                End If
            Next
            
'            CZKEM1.GetUserTmp CLng(txtMachNum.Text), CLng(dwEnrollNumber1), 0, TmpData1, TmpLength
'            Open "c:\bbb " & i & "" For Binary Access Write As #1
'            Put #1, 1, TmpData1
'            Close #1

            If Trim(tmpData) <> "" Then
                name = "-=-"
                sqlstr = "insert into fptable values(" & CLng(txtMachNum.Text) & "," & dwEnrollNmber & ",'" & name & "',0," & privilege & ",'" & passWord & "','" & tmpData & "')"
                'Insert all information into database,you could look database.
                connFP.Execute sqlstr
            End If
        Wend
    End If
    connFP.Close
End Sub

Private Sub cmdGetUserInfo_Click()
    Dim dwEnrollNmber As Long
    Dim name As String
    Dim passWord As String
    Dim privilege As Integer
    Dim Enabled As Boolean
    Dim xx As Boolean
    Dim i As Long
    
    lvX.Refresh
    
    lvX.ColumnHeaders.Add 1, , "EnrollnuMber"
    lvX.ColumnHeaders.Add 2, , "name"
    lvX.ColumnHeaders.Add 3, , "password"
    lvX.ColumnHeaders.Add 4, , "privilege"
    lvX.ColumnHeaders.Add 5, , "Enabled"
    i = 1

    xx = CZKEM1.ReadAllUserID(1)
    If xx Then
    While CZKEM1.GetAllUserInfo(CLng(txtMachNum.Text), dwEnrollNmber, name, passWord, privilege, Enabled)
        lvX.ListItems.Add i, , IIf(IsNull(dwEnrollNmber), "", dwEnrollNmber)
        With lvX.ListItems(i)
            If name = "" Then
                .SubItems(1) = "NUll"
            Else
                .SubItems(1) = IIf(IsNull(name), "", name)
            End If
            If passWord = "" Then
                .SubItems(2) = "Null"
            Else
                .SubItems(2) = IIf(IsNull(passWord), "", passWord)
            End If
            .SubItems(3) = IIf(IsNull(privilege), "", privilege)
            .SubItems(4) = IIf(IsNull(Enabled), "", Enabled)
        End With
    Wend
    End If
End Sub

Private Sub cmdRestore_Click()
    Dim dataFile
    Dim btmpFlag As Boolean
    
    dataFile = "c:\AAA"
    
    btmpFlag = CZKEM1.RestoreData(dataFile)
    
    If btmpFlag Then
        MsgBox "You are right", vbOKOnly + vbInformation, "Info"
    Else
        MsgBox "Fail", vbOKOnly + vbInformation, "Info"
    End If
End Sub

Private Sub cmdSetDevice_Click()
    frm3.Show
End Sub

Private Sub cmdWriteByDB_Click()
    Dim tmpData
    Dim i As Long
    Dim name
    Dim pass
    Dim xxen
    Dim pri  As Long
    Dim xx As Boolean
    Dim j
    Dim vTemp As Variant
    Dim bTemp(2048) As Byte
    Dim strlen As Long
    Dim strtempsql As String
    Dim indexx As Long
    
    indexx = 1
    
    strtempsql = "select TEMPLATEID,TEMPLATE from TEMPLATE"
    recFP.Open strtempsql, connFP, adOpenKeyset, adLockOptimistic, -1
    
    recFP.MoveFirst
    While Not recFP.EOF
        i = recFP.Fields("TEMPLATEID")
        xxen = True
        vTemp = recFP.Fields("template2")
        bTemp(0) = recFP.Fields("template")
        strlen = Len(tmpData)
        name = "NA " & i & ""
        j = i
        'Str2ByteArray tmpData, bTemp()
        
        CZKEM1.SetUserInfo CInt(txtMachNum.Text), CLng(i), CStr(name), CStr(pass), CInt(pri), xxen
        CZKEM1.SetUserTmp CInt(txtMachNum.Text), i, 0, bTemp(0)
        'xx = CZKEM1.SetUserTmpStr(CInt(txtMachNum.Text), CLng(i), 0, tmpData)
      
        Debug.Print i
'        If i Mod 10 = 0 Then
'            DoEvents
'            If j > 400 Then
'                For j = 1 To 10
'                    DoEvents
'                Next
'            End If
'            'CZKEM1.RefreshData CInt(txtMachNum.Text)
'        End If
        recFP.MoveNext
    Wend
End Sub

Private Sub Command1_Click()
    Dim dwEnrollNumber As Long
    Dim dwVerifyMode As Long
    Dim dwInOutMode As Long
    Dim timeStr As String
    Dim i As Long

    lvX.Refresh

    lvX.ColumnHeaders.Add 1, , "EnrollNumber", 2000
    lvX.ColumnHeaders.Add 2, , "dwVerifyMode", 2000
    lvX.ColumnHeaders.Add 3, , "dwInOutMode", 2000
    lvX.ColumnHeaders.Add 4, , "TimeStr", 4000
    
    If CZKEM1.ReadGeneralLogData(CInt(txtMachNum.Text)) Then
        i = i + 1
        While CZKEM1.GetGeneralLogDataStr(CInt(txtMachNum.Text), dwEnrollNumber, dwVerifyMode, dwInOutMode, timeStr)
            lvX.ListItems.Add i, , dwEnrollNumber
            With lvX.ListItems(i)
                .SubItems(1) = IIf(IsNull(dwVerifyMode), "", dwVerifyMode)
                .SubItems(2) = IIf(IsNull(dwInOutMode), "", dwInOutMode)
                .SubItems(3) = IIf(IsNull(timeStr), "", timeStr)
                
                saveLogs (dwEnrollNumber & " " & timeStr & " " & dwInOutMode)
            End With
            i = i + 1
            Debug.Print i
            lvX.Refresh
        Wend
    End If
End Sub

Private Sub Command2_Click()
    Dim tmpData
    Dim i As Long
    Dim name
    Dim pass
    Dim xxen
    Dim pri  As Long
    Dim xx As Boolean
    Dim j As Long
    Dim bTemp(2048) As Byte
    Dim strlen As Long
    
    xxen = True
    Template
    'ocoSgIzCUWAUaUIlOwpVQUOADGEkMpgE56tXPAZ5vCqXBtuyVMAKc7Y1zAVmqGLoBQsseD4IiRg2agfsHVF8CHEydLYGGTd9sgaSFENtCe48ZD4LiBhCfwl2IkpHCXUQEeLGcKHLywnAxXCiq8q6C8DEbKPLvJurDcDDbaSburqqqg3Aw26lmausqpu7w26lqam7qq28wmqluqqqyqvdF8JmpbzKm7y8zBjCYqW92qvNzMwawmClvcur3ezcG8JfpazLvO78zR3CXaOry77fDqHsycJcoou7z3cIEKH72cJXoYyrY2t2CROh+9rCVaGLu2FpdQCE
    'tmpData = "ocobg6AvVy8NNbJZLwk3KTMuZx0rM61LIi9lqwsqQ3RsG8WbO+wPFa40rBcnvjeqEpDCNeoMfjMprA0yRB8sEdKxRu0XoJJPLQ8XMz+uD524IS4RQKQ86xGFOXdqDzIlLCgiV6ohKBJEJxioEE6eKegOaTAeqAhEm15nBh6gGuIQXZdKFQWLqyzCJkEmhGoMmySOEVnwLwoQEcYNCAcEwMUJoeaFCcDED6JrjInAwwej5rnLqcDCdqPdm725GsDCc6TNvd25mcDBbKXN7d/LmYrAwWNocHcHDxehyriBwH5cXV9mcwcUHKLKl4fAflaBWWgHGaL7qIeBwE+BTU1KJqM8uoZ3JcBKoYdUOi2kDMt1RolHoZdCNCslKjOixjQ3JkihhzAwJiErPaKiNEYoSElJQzotIRoSTKIhJkYtRqHZUCYXD3ZcUEehJkc3RE1SUld1CQVzZlyhAldLwH5PVVdhcQMDc2mhAjdW4A=="
    'tmpData = "A1CA1C83A04029823D23442FC3177E292C422156AE22421242B554020F3D4B4F8204DDB62AC21031B41E020B43B135C21326964CC207169F5D83061E9F3AC20B153364820A2BCA684206CF2228C21465231BC30E5BB75AC20C38C724421CE04038421190353F820E9CAA18C20B4D273CC21585BC22021441334583139F1B4902068B13194208718A2CC3087CBB4482538A26646B0C9D840E12ADB8700A1115C304A2ACB98A12C0C200A3BBCAA99B15C0C175A4ABBCBA9BAB18C0C176A49ABCCABBAA19C07E72A59ABBCDBBBAAAC07E6EA5ABCCCDCCAAAA1BC07E69A5ADDDDDDDAA991CC07E64A5CCEEFFECB9991EC07E6062666C75060F17A1CBA881C07E5A5B5E646F05121BA2CAA877C07E525254596607171FA2CB887724C07E4D814C4725A33CCB777625C07E4B4A4843382BA32CDC646627C07E4948453D332A242935A2C43466C07E4948443B2F251E2342A2901466C07E4A49463E2E1F1506574B413B3735C0C14B4A462A120B7361554B443E3CC0C14F50556D07047065A1112248C0C2575E6B00016FA1134459C0C76BA156555DC0C96A6967E00000"
    tmpData = "ocodg6WpbnoMPqxzfgo4LWIFX4uwX8lUhSZORRYlP2nLBd2wPdUSOr06QhDQI0XZIj9DNokX2IJJ3QkKDGVVBhWVUhINEid8owosPoGXC86UdgEGHjpS2wV9EGJZB4krQR0OMKpYIQ+anFTFFoIYQdoRZik4gwpCoDIWDE2ZMhMOWiM7CxBAHkbBI1lCSuoH7rRTghKKIoSoEpuEaxhX4K0QEBHFdqObvbvbGcDEdKSau+usyRrEcaS7vNzLqRvDaaXMzc3cuanDZKXd3s/suajCW6HM7XUFDaL8uqjCVaGtv3AEEBmhvJghwlKhmp1mBBUdocqXI8JPgU5NTCSiPLqHJ8JLoYdUOi0koq3IR8JIoYZSNCsjJTGh5zbCRoFDOzAmHR06ofIlwkShqVEvIRYJWEtBOznCRKG6dS0SC3dkVUxFQsNJTE5UaAMEc2hfWFJPw01RVV5qdgF0a6EUVsRVXGNto+pCRkbFYWdvoslTV2Pg"
    'tmpData = "ocoPga+fP+4JJsJKLA2Ou0UsCBqhSCw3BrVtqwcYvG7qBZOkWCkMC6M7KBWYGlBoHJMxUmYHGcA1plsENkzmBxy4UKYLk6ZnpQeJMWzjBY0O1E8NEBF+d6aKiXiXaIh4wAGCpWiLl4Wmh8B+AuHHIh3AximhFwLAxSwnIhoNCcDFJCUhFgUGB8DEGx8jHA0ICQvAww0WHB8QoSi6EMDCAaS89Im6qsDCcXJ2Awui2pipGMDCbG5yBQ2i7KeJGsDDYWoDDKH9uILAw1BbBA6h7ciCwMNPT3YPoc/WgsDDTUdIFKOfyHiJwMRISRQTHKHJdx3g"
     'tmpData = "A1CA1E81AF384F2118ACBA4B4026A7BD48D434AB2540800D56A645D414513760BC09463A58A30F53AB500060302C4E713F3926507C260DAE7982092DA45B40151D3974910940864DFC04038D7152080BA565D40E20B66902083E8E69F8057E3564940AAF0F62B8040811312408DD954D780A72AC5B01122CB347400A31AC3892114794370004688B4E340677053180126A0572910484375BBC0DB63AB4EA131011C35D6069A3FEBA9A99C0C26181A4EFFDA8B897C0C265A586CDEDD9A9A80BC269A466BBEEDBB80B81C267A5789CDEEBDA890EC365A589BDFECDB899C363A187BD7303A2DDCA89C3608162687102A2EFCA99C35EA1789D6F030D15A1BA8AC358825C690716A1E9B922C354A177684E26A24B8898C34CA177563F34A2197787C445A4664568667731C442A46539AC647737C440A4636EF965563BC53E3D414BA2E354653FC5434B5BA393345545C65DA3D6314655E0"
    strlen = Len(tmpData)
    'Str2ByteArray tmpData, bTemp()
    For i = 1 To 100
        name = "-==-"
        CZKEM1.SetUserInfo CInt(txtMachNum.Text), CLng(i), CStr(name), CStr(pass), CInt(pri), xxen
        xx = CZKEM1.SetUserTmpStr(CInt(txtMachNum.Text), CLng(i), 0, tmpData)
       ' xx = CZKEM1.SetUserTmp(CInt(txtMachNum.Text), CLng(i), 0, bTemp(0))
        Debug.Print i
        If i Mod 10 = 0 Then
            DoEvents
            If i > 400 Then
                For j = 1 To 10
                    DoEvents
                Next
                If i = 3 Then Exit Sub
            End If
            'CZKEM1.RefreshData CInt(txtMachNum.Text)
        End If
    Next
End Sub

Private Sub Command3_Click()

End Sub

Private Sub Command4_Click()

End Sub

Private Sub CZKEM1_OnAttTransaction(ByVal EnrollNumber As Long, ByVal IsInValid As Long, ByVal AttState As Long, ByVal VerifyMethod As Long, ByVal Year As Long, ByVal Month As Long, ByVal Day As Long, ByVal Hour As Long, ByVal Minute As Long, ByVal Second As Long)
    'MsgBox "It is " & EnrollNumber & ",welcome!", vbOKOnly, "Even"
    DoEvents
End Sub

'Private Sub CZKEM1_OnEnrollFinger(ByVal EnrollNumber As Long, ByVal FingerIndex As Long)
'    'MsgBox "user " & EnrollNumber & " enroll number of " & FingerIndex + 1 & " finger"
'    DoEvents
'End Sub

Private Sub CZKEM1_OnKeyPress(ByVal Key As Long)
    'MsgBox "Key:" & Key & ""
    DoEvents
End Sub

Private Sub CZKEM1_OnNewUser(ByVal EnrollNumber As Long)
    'MsgBox "You are enrolling" & EnrollNumber & ""
    DoEvents
End Sub

Private Sub CZKEM1_OnVerify(ByVal UserID As Long)
    'MsgBox "" & UserID & " is verify"
    DoEvents
End Sub

Private Sub CZKEM1_Validate(Cancel As Boolean)
    If Cancel Then
        MsgBox "It is  cancel"
    Else
        MsgBox "successful"
    End If
End Sub

Private Sub Form_Load()
    frmCrtuser.Visible = False
    frmDel.Visible = False
    frmDeleteUser.Visible = False
    week(0) = "Mon."
    week(1) = "Tues."
    week(2) = "Wed."
    week(3) = "Thurs."
    week(4) = "Friday"
    week(5) = "Sat."
    week(6) = "Sun."
End Sub

Private Sub lvX_ColumnClick(ByVal ColumnHeader As MSComctlLib.ColumnHeader)
    lvX.SortKey = ColumnHeader.Index - 1
    lvX.Sorted = True
End Sub
