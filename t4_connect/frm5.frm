VERSION 5.00
Object = "{FE9DED34-E159-408E-8490-B720A5E632C7}#6.0#0"; "zkemkeeper.dll"
Begin VB.Form Form5 
   Caption         =   "Form5"
   ClientHeight    =   4845
   ClientLeft      =   60
   ClientTop       =   450
   ClientWidth     =   10140
   LinkTopic       =   "Form1"
   ScaleHeight     =   4845
   ScaleWidth      =   10140
   StartUpPosition =   3  'Windows Default
   Begin VB.OptionButton optCom 
      Caption         =   "ComConnect"
      Height          =   255
      Left            =   0
      TabIndex        =   7
      Top             =   720
      Width           =   1335
   End
   Begin VB.TextBox txtIP 
      Height          =   375
      Left            =   2520
      TabIndex        =   6
      Text            =   "192.168.0.2"
      Top             =   120
      Width           =   2655
   End
   Begin VB.TextBox txtPort 
      Height          =   405
      Left            =   6240
      TabIndex        =   5
      Text            =   "4370"
      Top             =   120
      Width           =   2535
   End
   Begin VB.TextBox txtComNum 
      Height          =   375
      Left            =   2520
      TabIndex        =   4
      Text            =   "1"
      Top             =   600
      Width           =   495
   End
   Begin VB.TextBox txtMachNum 
      Height          =   375
      Left            =   4680
      TabIndex        =   3
      Text            =   "1"
      Top             =   600
      Width           =   1095
   End
   Begin VB.TextBox txtRate 
      Height          =   375
      Left            =   6600
      TabIndex        =   2
      Text            =   "115200"
      Top             =   600
      Width           =   2175
   End
   Begin VB.CommandButton cmdConnect 
      Caption         =   "Connect"
      Height          =   375
      Left            =   9000
      TabIndex        =   1
      Top             =   720
      Width           =   1815
   End
   Begin zkemkeeperCtl.CZKEM CZKEM1 
      Height          =   855
      Left            =   0
      OleObjectBlob   =   "frm5.frx":0000
      TabIndex        =   0
      Top             =   0
      Width           =   495
   End
   Begin VB.Label labIP 
      Caption         =   "IP"
      Height          =   255
      Left            =   1440
      TabIndex        =   14
      Top             =   240
      Width           =   255
   End
   Begin VB.Label labPort 
      Caption         =   "port"
      Height          =   255
      Left            =   5520
      TabIndex        =   13
      Top             =   240
      Width           =   375
   End
   Begin VB.Label labCom 
      Caption         =   "ComNumber"
      Height          =   255
      Left            =   1440
      TabIndex        =   12
      Top             =   720
      Width           =   975
   End
   Begin VB.Label labMachNum 
      Caption         =   "MachineNumber"
      Height          =   375
      Left            =   3120
      TabIndex        =   11
      Top             =   720
      Width           =   1335
   End
   Begin VB.Label labRare 
      Caption         =   "Rate"
      Height          =   255
      Left            =   6000
      TabIndex        =   10
      Top             =   720
      Width           =   495
   End
   Begin VB.Label labSDK 
      Height          =   255
      Left            =   9000
      TabIndex        =   9
      Top             =   0
      Width           =   1695
   End
   Begin VB.Label labFirmV 
      Height          =   255
      Left            =   8880
      TabIndex        =   8
      Top             =   360
      Width           =   1935
   End
End
Attribute VB_Name = "Form5"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
