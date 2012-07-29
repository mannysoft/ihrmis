VERSION 5.00
Object = "{831FDD16-0C5C-11D2-A9FC-0000F8754DA1}#2.0#0"; "mscomctl.ocx"
Object = "{FE9DED34-E159-408E-8490-B720A5E632C7}#6.0#0"; "zkemkeeper.dll"
Begin VB.Form Form1 
   Caption         =   "Form1"
   ClientHeight    =   6750
   ClientLeft      =   60
   ClientTop       =   450
   ClientWidth     =   9690
   LinkTopic       =   "Form1"
   ScaleHeight     =   6750
   ScaleWidth      =   9690
   StartUpPosition =   3  'Windows Default
   Begin VB.TextBox txt_method 
      Height          =   375
      Left            =   1680
      TabIndex        =   8
      Text            =   "net"
      Top             =   120
      Width           =   1335
   End
   Begin VB.TextBox txtMachNum 
      Height          =   375
      Left            =   5400
      TabIndex        =   7
      Text            =   "1"
      Top             =   5400
      Width           =   1095
   End
   Begin VB.TextBox txtMacNum 
      Height          =   285
      Left            =   6120
      TabIndex        =   6
      Text            =   "1"
      Top             =   1440
      Width           =   2895
   End
   Begin VB.TextBox txtEvent 
      Height          =   2055
      Left            =   1920
      MultiLine       =   -1  'True
      ScrollBars      =   3  'Both
      TabIndex        =   5
      Text            =   "Form1.frx":0000
      Top             =   3960
      Width           =   1935
   End
   Begin VB.TextBox txtIP 
      Height          =   285
      Left            =   1680
      TabIndex        =   2
      Text            =   "192.168.0.2"
      Top             =   600
      Width           =   1335
   End
   Begin VB.CommandButton cmdConnect 
      Caption         =   "Connect"
      Height          =   375
      Left            =   3720
      TabIndex        =   1
      Top             =   600
      Width           =   1815
   End
   Begin zkemkeeperCtl.CZKEM CZKEM1 
      Height          =   615
      Left            =   120
      OleObjectBlob   =   "Form1.frx":000C
      TabIndex        =   0
      Top             =   120
      Width           =   735
   End
   Begin MSComctlLib.ListView lvX 
      Height          =   2535
      Left            =   4560
      TabIndex        =   4
      Top             =   2400
      Width           =   4215
      _ExtentX        =   7435
      _ExtentY        =   4471
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
   Begin VB.Label lblInfo 
      Caption         =   "Information"
      Height          =   1455
      Left            =   240
      TabIndex        =   3
      Top             =   1920
      Width           =   3375
   End
End
Attribute VB_Name = "Form1"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Private Sub cmdConnect_Click()

Dim dwEnrollNumber As Long
'Dim dwEnrollNumber As String
Dim dwVerifyMode As Long
Dim dwInOutMode As Long
Dim timeStr As String
Dim i As Long

'saveLogs ("ddd")
'If CZKEM1.Connect_Com(1, 1, 115200) Then // use for com
Dim ver As String
    If bConnected Then
        CZKEM1.Disconnect
    Else
        'if connect using network
        If txt_method.Text = "net" Then
        'MsgBox ("net")
            If CZKEM1.Connect_Net(txtIP.Text, 4370) Then
                If CZKEM1.GetFirmwareVersion(vMachineNumber, ver) Then
                    lblInfo.Caption = "Version=""" & ver & """"
                    If CZKEM1.GetDeviceIP(vMachineNumber, ver) Then
                        lblInfo.Caption = lblInfo.Caption & ", IP=" & ver
                        'Start of wrting to text file
                        
                        'clear the file
                        clear_file
                    
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
                        'Write message to text file
                        write_msg ("Success")
                        'clear all logs if checkbox is checked
                        'CZKEM1.ClearGLog txtMachNum.Text
                        'CZKEM1.SaveTheDataToFile  txtMachNum.Text, App.Path & "/logs/bakulaw.txt"
                        End
                        'End writing to text file
                    End If
                End If
            Else
                Beep
                lblInfo.Caption = "Connect fail."
                write_msg ("Failed")
                End
            End If
        End If
        
        
        
        
        
        'if connect using com
        If txt_method.Text = "com" Then
        'MsgBox ("com")
            If CZKEM1.Connect_Com(1, 1, 115200) Then
                If CZKEM1.GetFirmwareVersion(vMachineNumber, ver) Then
                    lblInfo.Caption = "Version=""" & ver & """"
                    If CZKEM1.GetDeviceIP(vMachineNumber, ver) Then
                        lblInfo.Caption = lblInfo.Caption & ", IP=" & ver
                        
                        'clear the file
                        clear_file
                        
                        'Start of wrting to text file
                        'Dim dwEnrollNumber As Long
                        'Dim dwEnrollNumber As String
                        'Dim dwVerifyMode As Long
                        'Dim dwInOutMode As Long
                        'Dim timeStr As String
                        'Dim i As Long
                    
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
                        'Write message to text file
                        write_msg ("Success")
                        'clear all logs if checkbox is checked
                        'CZKEM1.ClearGLog txtMachNum.Text
                        'CZKEM1.SaveTheDataToFile  txtMachNum.Text, App.Path & "/logs/bakulaw.txt"
                        End
                        'End writing to text file
                    End If
                End If
            Else
                Beep
                lblInfo.Caption = "Connect fail."
                write_msg ("Failed")
                End
            End If
        End If
        
        
        
        
        
        
    End If
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
    cmdConnect.Caption = "Connect"
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
Sub ShowButtonState()
    'cmdSetDeviceTime.Enabled = bConnected
    'cmdThreshold.Enabled = bConnected
    'cmdSetEnrollmentData.Enabled = bConnected
    'cmdSetEnrollStr.Enabled = bConnected
    'cmdSetUserTmp.Enabled = bConnected
    'cmdSetUserTmpStr.Enabled = bConnected
    'cmdDateFormat.Enabled = bConnected
    'cmd1To1Mode.Enabled = bConnected
    'cmd1ToNMode.Enabled = bConnected
    'cmdUpdateFirmware.Enabled = bConnected
    'cmdGetUserTmpStr.Enabled = bConnected
End Sub

Private Sub Form_Load()
Dim hFile As Long
Dim sFilename As String

sFilename = App.Path & "/logs/ip.txt"
   
  'obtain the next free file handle from the
  'system and and save the text box contents
hFile = FreeFile
   'Open sFilename For Output As #hFile
      'Print #hFile, Text1.Text
   'Close #hFile
   
   'this one is for reading the text file
   
    ' Get a free file number

nFileNum = FreeFile


' Open a text file for input. inputbox returns the path to read the file

Open App.Path & "/logs/ip.txt" For Input As nFileNum

lLineCount = 1

' Read the contents of the file

Do While Not EOF(nFileNum)

   Line Input #nFileNum, sNextLine

   'do something with it

   'add line numbers to it, in this case!

   'sNextLine = sNextLine & vbCrLf

   sText = sNextLine


Loop

txtIP.Text = sText


' Close the file

Close nFileNum



'METHOD ==============================
sFilename = App.Path & "/logs/method.txt"
   
  'obtain the next free file handle from the
  'system and and save the text box contents
hFile = FreeFile
   'Open sFilename For Output As #hFile
      'Print #hFile, Text1.Text
   'Close #hFile
   
   'this one is for reading the text file
   
    ' Get a free file number

nFileNum = FreeFile


' Open a text file for input. inputbox returns the path to read the file

Open App.Path & "/logs/method.txt" For Input As nFileNum

lLineCount = 1

' Read the contents of the file

Do While Not EOF(nFileNum)

   Line Input #nFileNum, sNextLine

   'do something with it

   'add line numbers to it, in this case!

   'sNextLine = sNextLine & vbCrLf

   sText = sNextLine


Loop

txt_method.Text = sText


' Close the file

Close nFileNum







cmdConnect_Click
End Sub
