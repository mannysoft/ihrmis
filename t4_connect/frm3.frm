VERSION 5.00
Begin VB.Form frm3 
   Caption         =   "Demo"
   ClientHeight    =   8085
   ClientLeft      =   3330
   ClientTop       =   1485
   ClientWidth     =   8490
   LinkTopic       =   "Form1"
   MaxButton       =   0   'False
   ScaleHeight     =   8085
   ScaleWidth      =   8490
   Begin VB.CommandButton cmdGetSN 
      Caption         =   "GetSensorSN"
      Height          =   375
      Left            =   4080
      TabIndex        =   31
      Top             =   7080
      Width           =   1575
   End
   Begin VB.TextBox txtFPTepLate1 
      Height          =   1575
      Left            =   5880
      MultiLine       =   -1  'True
      ScrollBars      =   2  'Vertical
      TabIndex        =   29
      Text            =   "frm3.frx":0000
      Top             =   6480
      Width           =   2535
   End
   Begin VB.CommandButton CmdFPConver 
      Caption         =   "FPconverToBiokey"
      Height          =   375
      Left            =   4080
      TabIndex        =   28
      ToolTipText     =   "convert finger template to other template that it was used by Biokey SDK"
      Top             =   6480
      Width           =   1695
   End
   Begin VB.TextBox txtFPTepLate 
      Height          =   1335
      Left            =   5880
      MultiLine       =   -1  'True
      ScrollBars      =   2  'Vertical
      TabIndex        =   26
      Text            =   "frm3.frx":0006
      Top             =   4680
      Width           =   2535
   End
   Begin VB.TextBox txtDisableDeviceT 
      Appearance      =   0  'Flat
      Height          =   375
      Left            =   6360
      TabIndex        =   25
      Top             =   3840
      Width           =   1815
   End
   Begin VB.CommandButton cmdDisableDT 
      Caption         =   " DisableDeviceWithTimeOut"
      Height          =   375
      Left            =   4080
      TabIndex        =   24
      Top             =   3840
      Width           =   2175
   End
   Begin VB.CommandButton cmdBeep 
      Caption         =   "Beep"
      Height          =   375
      Left            =   4080
      TabIndex        =   23
      Top             =   5640
      Width           =   1575
   End
   Begin VB.CommandButton cmdPlayVoiceByIndex 
      Caption         =   "PlayVoiceByIndex"
      Height          =   375
      Left            =   4080
      TabIndex        =   22
      Top             =   4440
      Width           =   1575
   End
   Begin VB.CommandButton cmdRestartDevice 
      Caption         =   "RestartDevice"
      Height          =   375
      Left            =   4080
      TabIndex        =   21
      Top             =   5040
      Width           =   1575
   End
   Begin VB.TextBox txtProductCode 
      Appearance      =   0  'Flat
      Enabled         =   0   'False
      Height          =   375
      Left            =   5760
      TabIndex        =   20
      Top             =   3240
      Width           =   2415
   End
   Begin VB.CommandButton cmdGetProductCode 
      Caption         =   "GetProductCode"
      Height          =   375
      Left            =   4080
      TabIndex        =   19
      Top             =   3240
      Width           =   1575
   End
   Begin VB.TextBox txtSDeviceMAC 
      Appearance      =   0  'Flat
      Height          =   375
      Left            =   5760
      TabIndex        =   18
      Top             =   2040
      Width           =   2415
   End
   Begin VB.CommandButton cmdSetDeviceMAC 
      Caption         =   "SetDeviceMAC"
      Height          =   375
      Left            =   4080
      TabIndex        =   17
      Top             =   2040
      Width           =   1575
   End
   Begin VB.TextBox txtSerialNumber 
      Appearance      =   0  'Flat
      Enabled         =   0   'False
      Height          =   375
      Left            =   5760
      TabIndex        =   16
      Top             =   2640
      Width           =   2415
   End
   Begin VB.CommandButton cmdGetSerialNumber 
      Caption         =   "GetSerialNumber"
      Height          =   375
      Left            =   4080
      TabIndex        =   15
      Top             =   2640
      Width           =   1575
   End
   Begin VB.TextBox txtGetDeviceMAC 
      Appearance      =   0  'Flat
      Enabled         =   0   'False
      Height          =   375
      Left            =   5760
      TabIndex        =   14
      Top             =   1440
      Width           =   2415
   End
   Begin VB.CommandButton cmdGetDeviceMAC 
      Caption         =   "GetDeviceMAC"
      Height          =   375
      Left            =   4080
      TabIndex        =   13
      Top             =   1440
      Width           =   1575
   End
   Begin VB.TextBox txtSetIP 
      Appearance      =   0  'Flat
      Height          =   375
      Left            =   5760
      TabIndex        =   12
      Top             =   840
      Width           =   2415
   End
   Begin VB.CommandButton cmdSetDeviceIP 
      Caption         =   "SetDeviceIP"
      Height          =   375
      Left            =   4080
      TabIndex        =   11
      Top             =   840
      Width           =   1575
   End
   Begin VB.TextBox txtDeviceIP 
      Appearance      =   0  'Flat
      Enabled         =   0   'False
      Height          =   375
      Left            =   5760
      TabIndex        =   10
      Top             =   240
      Width           =   2415
   End
   Begin VB.CommandButton cmdGetDeviceIP 
      Caption         =   "GetDeviceIP"
      Height          =   375
      Left            =   4080
      TabIndex        =   9
      Top             =   240
      Width           =   1575
   End
   Begin VB.CommandButton cmdGetDevInfo 
      Caption         =   "GetDeviceInfo"
      Height          =   375
      Left            =   120
      TabIndex        =   8
      Top             =   2880
      Width           =   1455
   End
   Begin VB.ListBox ls2 
      Appearance      =   0  'Flat
      Height          =   4320
      ItemData        =   "frm3.frx":0189
      Left            =   120
      List            =   "frm3.frx":018B
      TabIndex        =   7
      Top             =   3240
      Width           =   3855
   End
   Begin VB.CommandButton cmdWriteLcd 
      Caption         =   "WriteLCD"
      Height          =   375
      Left            =   120
      TabIndex        =   6
      Top             =   1680
      Width           =   1455
   End
   Begin VB.ListBox ls1 
      Height          =   2400
      ItemData        =   "frm3.frx":018D
      Left            =   1680
      List            =   "frm3.frx":018F
      TabIndex        =   5
      Top             =   240
      Width           =   2295
   End
   Begin VB.CommandButton cmdGetDeviStat 
      Caption         =   "GetDeviceStatus"
      Height          =   375
      Left            =   120
      TabIndex        =   4
      Top             =   2400
      Width           =   1455
   End
   Begin VB.CommandButton cmdDisEnableClock 
      Caption         =   "DisEnableClock"
      Height          =   375
      Left            =   120
      TabIndex        =   3
      Top             =   1320
      Width           =   1455
   End
   Begin VB.CommandButton cmdEnableClock 
      Caption         =   "EnableClock"
      Height          =   375
      Left            =   120
      TabIndex        =   2
      Top             =   960
      Width           =   1455
   End
   Begin VB.CommandButton cmdDisEnable 
      Caption         =   "DisEnableDevice"
      Height          =   375
      Left            =   120
      TabIndex        =   1
      Top             =   600
      Width           =   1455
   End
   Begin VB.CommandButton cmdEnable 
      Caption         =   "EnableDevice"
      Height          =   375
      Left            =   120
      TabIndex        =   0
      Top             =   240
      Width           =   1455
   End
   Begin VB.Label Label2 
      Caption         =   "finger template for BIOKEY SDK"
      Height          =   255
      Left            =   5880
      TabIndex        =   30
      Top             =   6240
      Width           =   2535
   End
   Begin VB.Label Label1 
      Caption         =   "finger template for machine"
      Height          =   375
      Left            =   5880
      TabIndex        =   27
      Top             =   4320
      Width           =   2535
   End
End
Attribute VB_Name = "frm3"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
'**********************************************
'Time:2005-6-22                               *
'purpose:Demo                                 *
'author:YongHong Pei,work for zksoftware      *
'contact:pyhppp@hotmail.com                   *
'**********************************************
'follow code get access testing by zkemsdk 5.10.90

Private Sub cmdBeep_Click()
    'Some machine does not,for example,F4 can
    frm2.CZKEM1.Beep 150
End Sub

Private Sub cmdDisableDT_Click()
    frm2.CZKEM1.DisableDeviceWithTimeOut CInt(frm2.txtMachNum.Text), CInt(txtDisableDeviceT.Text)
End Sub

Private Sub cmdDisEnable_Click()
    'The device will be in work state
    frm2.CZKEM1.EnableDevice CInt(frm2.txtMachNum.Text), False
End Sub

Private Sub cmdDisEnableClock_Click()
    'pls look the time of machine
    frm2.CZKEM1.EnableClock 0
End Sub

Private Sub cmdEnable_Click()
    frm2.CZKEM1.EnableDevice CInt(frm2.txtMachNum.Text), True
End Sub

Private Sub cmdEnableClock_Click()
    'pls look the time of machine
    frm2.CZKEM1.EnableClock 1
End Sub

Private Sub CmdFPConver_Click()
    Dim TmpData1
    Dim TmpData2 As String
    Dim Size As Long
    TmpData1 = "ocojg52rWoEOOq1egQw1rEtBFp4uRAESmkBLQRZ0wlLBB21BKUEM3EIuQTPmKGhBCCm8fEkdw7MnQRE6QCXBC9DDVVEE3Kk3QR0iFjvBDRJAckEMz5VggQYbMn1BDy8uKwkNMItPyQ0VL0uBSJozS4FQhR8/ARSDoTHBIl0sIYEKQKYlghJDoxlBD02aKcERZJwaQRBbhioBKHkRS4EJhyUygVtEozPBPwi4PsEQij5DQQl8HXQJDZtkLBOrMM8LEBHCAgQPFBgPBoHAwgKjrfxTfBfAwgIEDKLaiZwdwMF1pKzLrMuqIcDBc6WZ693rmJrAwW+km87vzJmCwMFmoa3/DBWjy5qG"
    
    frm2.CZKEM1.FPTempConvertStr TmpData1, TmpData2, Size
    txtFPTepLate1.Text = TmpData2
    Size = Len(TmpData2)
End Sub

Private Sub cmdGetDeviceIP_Click()
    Dim IPAddr As String
    
    frm2.CZKEM1.GetDeviceIP CInt(frm2.txtMachNum.Text), IPAddr
    txtDeviceIP.Text = IPAddr
End Sub

Private Sub cmdGetDeviceMAC_Click()
    Dim sMac As String
    
    frm2.CZKEM1.GetDeviceMAC CInt(frm2.txtMachNum.Text), sMac
    txtGetDeviceMAC.Text = sMac
End Sub

Private Sub cmdGetDevInfo_Click()
    Dim i As Integer
    Dim dwValue As Long
    Dim bget As Boolean
    
    For i = 1 To 35
        bget = frm2.CZKEM1.GetDeviceInfo(CInt(frm2.txtMachNum.Text), i, dwValue)
        If bget = False Then Exit Sub
        If i = 1 Then
            ls2.AddItem "Max num of manager:" & dwValue & ""
            ls2.Refresh
        End If
        If i = 2 Then
            ls2.AddItem "Machine num:" & dwValue & ""
            ls2.Refresh
        End If
        If i = 3 Then
            If dwValue = 0 Then
                ls2.AddItem "Lanage:English"
                ls2.Refresh
            ElseIf dwValue = 1 Then
                ls2.AddItem "Lanage:Chinese"
                ls2.Refresh
            ElseIf dwValue = 2 Then
                ls2.AddItem "Lanage:Korea"
                ls2.Refresh
            End If
        End If
        If i = 4 Then
            ls2.AddItem "Close Machine self-motion time:" & dwValue & "M"
            ls2.Refresh
        End If
        If i = 5 Then
                ls2.AddItem "Export signal of controling mentor:" & dwValue & ""
                ls2.Refresh
        End If
        If i = 6 Then
                ls2.AddItem "Max num of Attdance alarm:" & dwValue & ""
                ls2.Refresh
        End If
        If i = 7 Then
                ls2.AddItem "Max num of manage newsreel alarm:" & dwValue & ""
                ls2.Refresh
        End If
        If i = 8 Then
            ls2.AddItem "Min space of two validate:" & dwValue & ""
            ls2.Refresh
        End If
        If i = 9 Then
            If dwValue <> 6 Then
                ls2.AddItem "Rate:" & 1200 * (dwValue + 1) & "bps"
                ls2.Refresh
            Else
                ls2.AddItem "Rate:115200bps"
                ls2.Refresh
            End If
        End If
        If i = 10 Then
            If dwValue = 0 Then
                ls2.AddItem "parity check:NO"
                ls2.Refresh
            ElseIf dwValue = 1 Then
                ls2.AddItem "Parity check:even"
                ls2.Refresh
            ElseIf dwValue = 2 Then
                ls2.AddItem "Parity check:odd"
                ls2.Refresh
            End If
        End If
        If i = 11 Then
            ls2.AddItem "Stop sing:" & (dwValue + 1) * 2 & "Bits"
            ls2.Refresh
        End If
        If i = 12 Then
            If dwValue = 0 Then
                ls2.AddItem "Data segmentation sign:" / ""
                ls2.Refresh
            ElseIf dwValue = 1 Then
                ls2.AddItem "Data segmentation sign:-"
                ls2.Refresh
            End If
        End If
        If i = 13 Then
            If dwValue = 1 Then
                ls2.AddItem "Connect net:YES"
                ls2.Refresh
            ElseIf dwValue = 0 Then
                ls2.AddItem "Connect net:NO"
                ls2.Refresh
            End If
        End If
        If i = 14 Then
            If dwValue = 1 Then
                ls2.AddItem "RS232 Connect:YES"
                ls2.Refresh
            ElseIf dwValue = 0 Then
                ls2.AddItem "RS232 Connect:NO"
                ls2.Refresh
            End If
        End If
        If i = 15 Then
            If dwValue = 1 Then
                ls2.AddItem "RS485 Connect:YES"
                ls2.Refresh
            ElseIf dwValue = 0 Then
                ls2.AddItem "RS485 Connect:NO"
                ls2.Refresh
            End If
        End If
        If i = 16 Then
            If dwValue = 1 Then
                ls2.AddItem "voice register:YES"
                ls2.Refresh
            Else
                ls2.AddItem "voice register:NO"
                ls2.Refresh
            End If
        End If
        If i = 17 Then
            ls2.AddItem "validate speed:" & dwValue & ""
            ls2.Refresh
        End If
        If i = 18 Then
            ls2.AddItem "idlesse times:" & dwValue & ""
            ls2.Refresh
        End If
        If i = 19 Then
            ls2.AddItem "time of closing machine:" & dwValue & ""
            ls2.Refresh
        End If
        If i = 20 Then
            ls2.AddItem "time of setup machine:" & dwValue & ""
            ls2.Refresh
        End If
        If i = 21 Then
            ls2.AddItem "time of sleep:" & dwValue & ""
            ls2.Refresh
        End If
        If i = 22 Then
            ls2.AddItem "self-motion beep:" & dwValue & ""
            ls2.Refresh
        End If
        If i = 23 Then
            ls2.AddItem "Match threhold:" & dwValue & ""
            ls2.Refresh
        End If
        If i = 24 Then
            ls2.AddItem "mistach threshord:" & dwValue & ""
            ls2.Refresh
        End If
        If i = 25 Then
            If dwValue = 1 Then
                ls2.AddItem "1:1:YES"
                ls2.Refresh
            Else
                ls2.AddItem "1:1:NO"
                ls2.Refresh
            End If
        End If
        If i = 26 Then
            If dwValue = 1 Then
                ls2.AddItem "Show score:YES"
                ls2.Refresh
            Else
                ls2.AddItem "Show score:NO"
                ls2.Refresh
            End If
        End If
        If i = 27 Then
            ls2.AddItem "Combination number of unlock persons:" & dwValue & ""
            ls2.Refresh
        End If
        If i = 28 Then
            If dwValue = 1 Then
                ls2.AddItem "Whether to use card for verification:YES"
                ls2.Refresh
            Else
                ls2.AddItem "Whether to use card for verification:NO"
                ls2.Refresh
            End If
        End If
        If i = 29 Then
            ls2.AddItem "Network speed:" & dwValue & ""
            ls2.Refresh
        End If
        If i = 30 Then
            If dwValue = 1 Then
                ls2.AddItem "Must register card No:YES"
                ls2.Refresh
            Else
                ls2.AddItem "Must register card No:NO"
                ls2.Refresh
            End If
        End If
        If i = 31 Then
            ls2.AddItem "retention time for machine under temporary status:" & dwValue & ""
            ls2.Refresh
        End If
        If i = 32 Then
            ls2.AddItem "Type retention time:" & dwValue & ""
            ls2.Refresh
        End If
        If i = 33 Then
            ls2.AddItem "Retention time for menu:" & dwValue & ""
            ls2.Refresh
        End If
        If i = 34 Then
            ls2.AddItem "Date formate:" & dwValue & ""
            ls2.Refresh
        End If
        If i = 35 Then
            If dwValue = 1 Then
                ls2.AddItem "Whether is 1: 1 match or not?:YES"
                ls2.Refresh
            Else
                ls2.AddItem "Whether is 1: 1 match or not?:NO"
                ls2.Refresh
            End If
        End If
    Next i
End Sub

Private Sub cmdGetDeviStat_Click()
    Dim i As Integer
    Dim dwValue As Long
    
    For i = 1 To 6
        frm2.CZKEM1.GetDeviceStatus CInt(frm2.txtMachNum.Text), i, dwValue
        If i = 1 Then
            ls1.AddItem "Manage number:" & dwValue & ""
            ls1.Refresh
        End If
        If i = 2 Then
            ls1.AddItem "User number:" & dwValue & ""
            ls1.Refresh
        End If
        If i = 3 Then
            ls1.AddItem "Finger templata number:" & dwValue & ""
            ls1.Refresh
        End If
        If i = 4 Then
            ls1.AddItem "PassWord number:" & dwValue & ""
            ls1.Refresh
        End If
        If i = 5 Then
            ls1.AddItem "Manage run number:" & dwValue & ""
            ls1.Refresh
        End If
        If i = 6 Then
            ls1.AddItem "Attdance number:" & dwValue & ""
            ls1.Refresh
        End If
    Next
End Sub

Private Sub cmdGetProductCode_Click()
    Dim lpsxProductCode As String
    
    frm2.CZKEM1.GetProductCode CInt(frm2.txtMachNum.Text), lpsxProductCode
    txtProductCode.Text = lpsxProductCode
End Sub

Private Sub cmdGetSerialNumber_Click()
    Dim dwSerialNumber As String
    
    frm2.CZKEM1.GetSerialNumber CInt(frm2.txtMachNum.Text), dwSerialNumber
    txtSerialNumber.Text = dwSerialNumber
End Sub

Private Sub cmdGetSN_Click()
    Dim SensorSN As String
    
    frm2.CZKEM1.GetSensorSN 1, SensorSN
End Sub

Private Sub cmdSetDeviceIP_Click()
    frm2.CZKEM1.SetDeviceIP CInt(frm2.txtMachNum.Text), txtSetIP.Text
End Sub

Private Sub cmdSetDeviceMAC_Click()
    frm2.CZKEM1.SetDeviceMAC CInt(frm2.txtMachNum.Text), txtSDeviceMAC.Text
End Sub

Private Sub cmdWriteLcd_Click()
    frm2.CZKEM1.ClearLCD
    frm2.CZKEM1.EnableClock 0
    frm2.CZKEM1.WriteLCD 0, 0, "God!God!What are"
    frm2.CZKEM1.WriteLCD 1, 0, "you doing!!!"
End Sub

Private Sub cmdRestartDevice_Click()
    frm2.CZKEM1.RestartDevice CInt(frm2.txtMachNum.Text)
End Sub

Private Sub cmdPlayVoiceByIndex_Click()
    frm2.CZKEM1.PlayVoiceByIndex 2
End Sub

