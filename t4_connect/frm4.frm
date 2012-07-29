VERSION 5.00
Begin VB.Form frm4 
   Caption         =   "AccessControl"
   ClientHeight    =   6135
   ClientLeft      =   60
   ClientTop       =   345
   ClientWidth     =   11610
   BeginProperty Font 
      Name            =   "MS Sans Serif"
      Size            =   9.75
      Charset         =   0
      Weight          =   400
      Underline       =   0   'False
      Italic          =   0   'False
      Strikethrough   =   0   'False
   EndProperty
   LinkTopic       =   "Form1"
   MaxButton       =   0   'False
   ScaleHeight     =   6135
   ScaleWidth      =   11610
   StartUpPosition =   3  'Windows Default
   Begin VB.CommandButton cmdOpenDoor 
      Caption         =   "OpenTheDoor"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   6000
      TabIndex        =   76
      Top             =   2040
      Width           =   1455
   End
   Begin VB.ListBox lsUnlockGrp 
      Height          =   1260
      Left            =   9240
      TabIndex        =   75
      Top             =   4680
      Width           =   2295
   End
   Begin VB.CommandButton cmdGetUnlockGrp 
      Caption         =   "GetUnlockGrp"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   9720
      TabIndex        =   74
      Top             =   4200
      Width           =   1455
   End
   Begin VB.TextBox txtGrp10 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   9840
      TabIndex        =   73
      Top             =   3840
      Width           =   1575
   End
   Begin VB.TextBox txtGrp9 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   9840
      TabIndex        =   72
      Top             =   3480
      Width           =   1575
   End
   Begin VB.TextBox txtGrp8 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   9840
      TabIndex        =   71
      Top             =   3120
      Width           =   1575
   End
   Begin VB.TextBox txtGrp7 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   9840
      TabIndex        =   70
      Top             =   2760
      Width           =   1575
   End
   Begin VB.TextBox txtGrp6 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   9840
      TabIndex        =   69
      Text            =   "24"
      Top             =   2400
      Width           =   1575
   End
   Begin VB.TextBox txtGrp5 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   360
      Left            =   9840
      TabIndex        =   68
      Text            =   "23"
      Top             =   2040
      Width           =   1575
   End
   Begin VB.TextBox txtGrp4 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   360
      Left            =   9840
      TabIndex        =   67
      Text            =   "15"
      Top             =   1680
      Width           =   1575
   End
   Begin VB.TextBox txtGrp3 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   9840
      TabIndex        =   66
      Text            =   "14"
      Top             =   1320
      Width           =   1575
   End
   Begin VB.TextBox txtGrp2 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   360
      Left            =   9840
      TabIndex        =   65
      Text            =   "13"
      Top             =   960
      Width           =   1575
   End
   Begin VB.TextBox txtGrp1 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   345
      Left            =   9840
      TabIndex        =   64
      Text            =   "12"
      Top             =   600
      Width           =   1575
   End
   Begin VB.CommandButton cmdSetUnlockGroups 
      Caption         =   "SetUnlockGroups"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   9720
      TabIndex        =   53
      Top             =   240
      Width           =   1455
   End
   Begin VB.ListBox lsGrpTZ 
      Height          =   2700
      Left            =   7200
      TabIndex        =   52
      Top             =   3120
      Width           =   1815
   End
   Begin VB.CommandButton cmdGetGrpTZ 
      Caption         =   "GetGoupTZStr"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   7200
      TabIndex        =   51
      Top             =   2520
      Width           =   1455
   End
   Begin VB.TextBox txtGrpTZ3 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   5520
      TabIndex        =   48
      Text            =   "3"
      Top             =   5400
      Width           =   1335
   End
   Begin VB.TextBox txtGrpTZ2 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   5520
      TabIndex        =   47
      Text            =   "2"
      Top             =   4560
      Width           =   1335
   End
   Begin VB.TextBox txtGrpTZ1 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   360
      Left            =   5520
      TabIndex        =   46
      Text            =   "1"
      Top             =   3720
      Width           =   1335
   End
   Begin VB.ComboBox cmbSGroupID 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   315
      ItemData        =   "frm4.frx":0000
      Left            =   5520
      List            =   "frm4.frx":0022
      TabIndex        =   44
      Text            =   "1"
      Top             =   3120
      Width           =   1335
   End
   Begin VB.CommandButton cmdSetGroupStr 
      Caption         =   "SetGroupTZStr"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   5040
      TabIndex        =   42
      Top             =   2520
      Width           =   1455
   End
   Begin VB.ListBox lsUserGroup 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   1230
      Left            =   7080
      TabIndex        =   41
      Top             =   720
      Width           =   1935
   End
   Begin VB.CommandButton cdmGUGroup 
      Caption         =   "GetUserGrop"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   7080
      TabIndex        =   40
      Top             =   240
      Width           =   1455
   End
   Begin VB.ComboBox cmbGroupID 
      Height          =   360
      ItemData        =   "frm4.frx":0045
      Left            =   5400
      List            =   "frm4.frx":0058
      TabIndex        =   38
      Text            =   "1"
      Top             =   1560
      Width           =   1455
   End
   Begin VB.TextBox txtSUGID 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   5400
      TabIndex        =   36
      Text            =   "1"
      Top             =   720
      Width           =   1335
   End
   Begin VB.CommandButton cmdSetUserGroup 
      Caption         =   "SetUserGroup"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   4920
      TabIndex        =   35
      Top             =   240
      Width           =   1455
   End
   Begin VB.TextBox txtTZ3 
      Height          =   360
      Left            =   2760
      TabIndex        =   34
      Text            =   "3"
      Top             =   5400
      Width           =   1335
   End
   Begin VB.TextBox txtTZ2 
      Height          =   375
      Left            =   2760
      TabIndex        =   32
      Text            =   "2"
      Top             =   4560
      Width           =   1335
   End
   Begin VB.TextBox txtTZ1 
      Height          =   375
      Left            =   2760
      TabIndex        =   30
      Text            =   "1"
      Top             =   3720
      Width           =   1335
   End
   Begin VB.CommandButton cmdSeuUserTzInfo 
      Caption         =   "SetUserTZInfo"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   2640
      TabIndex        =   28
      Top             =   3240
      Width           =   1455
   End
   Begin VB.ListBox lsUserTZ 
      Height          =   1740
      Left            =   120
      TabIndex        =   27
      Top             =   4200
      Width           =   1455
   End
   Begin VB.TextBox txtUserID 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   120
      TabIndex        =   26
      Text            =   "User ID"
      Top             =   3720
      Width           =   1455
   End
   Begin VB.CommandButton cmdGetUserTzInfo 
      Caption         =   "GetUserTzInfo"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   120
      TabIndex        =   25
      Top             =   3240
      Width           =   1455
   End
   Begin VB.CommandButton cmdTzInfo 
      Caption         =   "SetTzInfo"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   2640
      TabIndex        =   24
      Top             =   240
      Width           =   1455
   End
   Begin VB.TextBox txt77 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   285
      Left            =   3720
      TabIndex        =   23
      Text            =   "1818"
      Top             =   720
      Width           =   735
   End
   Begin VB.TextBox txt7 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   285
      Left            =   2400
      TabIndex        =   22
      Text            =   "0808"
      Top             =   720
      Width           =   735
   End
   Begin VB.TextBox txt66 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   285
      Left            =   3720
      TabIndex        =   21
      Text            =   "1818"
      Top             =   2880
      Width           =   735
   End
   Begin VB.TextBox txt6 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   285
      Left            =   2400
      TabIndex        =   20
      Text            =   "0808"
      Top             =   2880
      Width           =   735
   End
   Begin VB.TextBox txt55 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   285
      Left            =   3720
      TabIndex        =   19
      Text            =   "1818"
      Top             =   2520
      Width           =   735
   End
   Begin VB.TextBox txt5 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   285
      Left            =   2400
      TabIndex        =   18
      Text            =   "0808"
      Top             =   2520
      Width           =   735
   End
   Begin VB.TextBox txt44 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   285
      Left            =   3720
      TabIndex        =   17
      Text            =   "1818"
      Top             =   2160
      Width           =   735
   End
   Begin VB.TextBox txt4 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   285
      Left            =   2400
      TabIndex        =   16
      Text            =   "0808"
      Top             =   2160
      Width           =   735
   End
   Begin VB.TextBox txt33 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   285
      Left            =   3720
      TabIndex        =   15
      Text            =   "2359"
      Top             =   1800
      Width           =   735
   End
   Begin VB.TextBox txt3 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   285
      Left            =   2400
      TabIndex        =   14
      Text            =   "0808"
      Top             =   1800
      Width           =   735
   End
   Begin VB.TextBox txt22 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   285
      Left            =   3720
      TabIndex        =   13
      Text            =   "1818"
      Top             =   1440
      Width           =   735
   End
   Begin VB.TextBox txt2 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   285
      Left            =   2400
      TabIndex        =   12
      Text            =   "0808"
      Top             =   1440
      Width           =   735
   End
   Begin VB.TextBox txt11 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   285
      Left            =   3720
      TabIndex        =   11
      Text            =   "1818"
      Top             =   1080
      Width           =   735
   End
   Begin VB.TextBox txt1 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   285
      Left            =   2400
      TabIndex        =   3
      Text            =   "0808"
      Top             =   1080
      Width           =   735
   End
   Begin VB.ListBox lstTz 
      Appearance      =   0  'Flat
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   1785
      Left            =   120
      TabIndex        =   2
      Top             =   1200
      Width           =   1455
   End
   Begin VB.TextBox txtTzIndex 
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   120
      TabIndex        =   1
      Text            =   "1"
      Top             =   720
      Width           =   1455
   End
   Begin VB.CommandButton cmdGetTzInfo 
      Caption         =   "GetTzInfo"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   120
      TabIndex        =   0
      Top             =   240
      Width           =   1455
   End
   Begin VB.Label Label26 
      Caption         =   "Group10"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   9120
      TabIndex        =   63
      Top             =   3960
      Width           =   735
   End
   Begin VB.Label Label25 
      Caption         =   "Group9"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   9120
      TabIndex        =   62
      Top             =   3600
      Width           =   855
   End
   Begin VB.Label Label24 
      Caption         =   "Group8"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   9120
      TabIndex        =   61
      Top             =   3240
      Width           =   735
   End
   Begin VB.Label Label23 
      Caption         =   "Group7"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   9120
      TabIndex        =   60
      Top             =   2880
      Width           =   735
   End
   Begin VB.Label Label22 
      Caption         =   "Group6"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   9120
      TabIndex        =   59
      Top             =   2520
      Width           =   735
   End
   Begin VB.Label Label21 
      Caption         =   "Group5"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   9120
      TabIndex        =   58
      Top             =   2160
      Width           =   615
   End
   Begin VB.Label Label20 
      Caption         =   "Group4"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   9120
      TabIndex        =   57
      Top             =   1800
      Width           =   615
   End
   Begin VB.Label Label19 
      Caption         =   "Group3"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   9120
      TabIndex        =   56
      Top             =   1440
      Width           =   615
   End
   Begin VB.Label Label18 
      Caption         =   "Group2"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   9120
      TabIndex        =   55
      Top             =   1080
      Width           =   615
   End
   Begin VB.Label Label17 
      Caption         =   "Group1"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   9120
      TabIndex        =   54
      Top             =   720
      Width           =   615
   End
   Begin VB.Label Label16 
      Caption         =   "TZ3"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   4560
      TabIndex        =   50
      Top             =   5400
      Width           =   735
   End
   Begin VB.Label Label15 
      Caption         =   "TZ2"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   4560
      TabIndex        =   49
      Top             =   4560
      Width           =   855
   End
   Begin VB.Label Label14 
      Caption         =   "TZ1"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   4560
      TabIndex        =   45
      Top             =   3720
      Width           =   615
   End
   Begin VB.Label Label13 
      Caption         =   "GroupID"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   4560
      TabIndex        =   43
      Top             =   3240
      Width           =   615
   End
   Begin VB.Label Label12 
      Caption         =   "GroupID"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   4560
      TabIndex        =   39
      Top             =   1560
      Width           =   735
   End
   Begin VB.Label Label11 
      Caption         =   "UserID"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   4560
      TabIndex        =   37
      Top             =   840
      Width           =   615
   End
   Begin VB.Label Label10 
      Caption         =   "TZ Three"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   1920
      TabIndex        =   33
      Top             =   5520
      Width           =   735
   End
   Begin VB.Label Label9 
      Caption         =   "TZ Two"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   1920
      TabIndex        =   31
      Top             =   4680
      Width           =   735
   End
   Begin VB.Label Label8 
      Caption         =   "TZ One"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   1920
      TabIndex        =   29
      Top             =   3840
      Width           =   615
   End
   Begin VB.Line Line21 
      X1              =   3120
      X2              =   3600
      Y1              =   840
      Y2              =   840
   End
   Begin VB.Line Line20 
      X1              =   3600
      X2              =   3480
      Y1              =   840
      Y2              =   720
   End
   Begin VB.Line Line19 
      X1              =   3600
      X2              =   3480
      Y1              =   840
      Y2              =   960
   End
   Begin VB.Line Line18 
      X1              =   3120
      X2              =   3600
      Y1              =   3000
      Y2              =   3000
   End
   Begin VB.Line Line17 
      X1              =   3600
      X2              =   3480
      Y1              =   3000
      Y2              =   2880
   End
   Begin VB.Line Line16 
      X1              =   3600
      X2              =   3480
      Y1              =   3000
      Y2              =   3120
   End
   Begin VB.Line Line15 
      X1              =   3120
      X2              =   3600
      Y1              =   2640
      Y2              =   2640
   End
   Begin VB.Line Line14 
      X1              =   3600
      X2              =   3480
      Y1              =   2640
      Y2              =   2520
   End
   Begin VB.Line Line13 
      X1              =   3600
      X2              =   3480
      Y1              =   2640
      Y2              =   2760
   End
   Begin VB.Line Line12 
      X1              =   3120
      X2              =   3600
      Y1              =   2280
      Y2              =   2280
   End
   Begin VB.Line Line11 
      X1              =   3600
      X2              =   3480
      Y1              =   2280
      Y2              =   2160
   End
   Begin VB.Line Line10 
      X1              =   3600
      X2              =   3480
      Y1              =   2280
      Y2              =   2400
   End
   Begin VB.Line Line9 
      X1              =   3120
      X2              =   3600
      Y1              =   1920
      Y2              =   1920
   End
   Begin VB.Line Line8 
      X1              =   3600
      X2              =   3480
      Y1              =   1920
      Y2              =   1800
   End
   Begin VB.Line Line7 
      X1              =   3600
      X2              =   3480
      Y1              =   1920
      Y2              =   2040
   End
   Begin VB.Line Line6 
      X1              =   3600
      X2              =   3480
      Y1              =   1560
      Y2              =   1680
   End
   Begin VB.Line Line5 
      X1              =   3600
      X2              =   3480
      Y1              =   1560
      Y2              =   1440
   End
   Begin VB.Line Line4 
      X1              =   3120
      X2              =   3600
      Y1              =   1560
      Y2              =   1560
   End
   Begin VB.Line Line3 
      X1              =   3600
      X2              =   3480
      Y1              =   1200
      Y2              =   1320
   End
   Begin VB.Line Line2 
      X1              =   3480
      X2              =   3600
      Y1              =   1080
      Y2              =   1200
   End
   Begin VB.Line Line1 
      X1              =   3120
      X2              =   3600
      Y1              =   1200
      Y2              =   1200
   End
   Begin VB.Label Label7 
      Caption         =   "Sun."
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   1680
      TabIndex        =   10
      Top             =   720
      Width           =   615
   End
   Begin VB.Label Label6 
      Caption         =   "Sat."
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   1680
      TabIndex        =   9
      Top             =   2880
      Width           =   495
   End
   Begin VB.Label Label5 
      Caption         =   "Friday"
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   1680
      TabIndex        =   8
      Top             =   2520
      Width           =   615
   End
   Begin VB.Label Label4 
      Caption         =   "Thurs."
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   1680
      TabIndex        =   7
      Top             =   2160
      Width           =   615
   End
   Begin VB.Label Label3 
      Caption         =   "Wed."
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   1680
      TabIndex        =   6
      Top             =   1800
      Width           =   495
   End
   Begin VB.Label Label2 
      Caption         =   "Tues."
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   1680
      TabIndex        =   5
      Top             =   1440
      Width           =   615
   End
   Begin VB.Label Label1 
      Caption         =   "Mon."
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Left            =   1680
      TabIndex        =   4
      Top             =   1080
      Width           =   615
   End
End
Attribute VB_Name = "frm4"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
'**********************************************
'Time:2005-7-30                               *
'purpose:Demo for access control              *
'author:YongHong Pei,work for zksoftware      *
'contact:pyhppp@hotmail.com                   *
'**********************************************
'follow code get access testing by zkemsdk 5.10.90
' a user pertain to a group(default 1),Group has TZ(3,tz1 or tz2 tz3),user has TZ(tz1 or tz2 or tz3).
' one tz is hebdomad(1-99).

Private Sub cdmGUGroup_Click()
    Dim userGrp As Long
    Dim bGUG As Boolean
    
    bGUG = frm2.CZKEM1.GetUserGroup(frm2.txtMachNum.Text, txtSUGID.Text, userGrp)
    If bGUG Then
        lsUserGroup.AddItem "user" & txtSUGID.Text & "'s" & " group is " & CStr(userGrp)
    End If
End Sub

Private Sub cmdGetGrpTZ_Click()
    Dim TZS As String
    Dim bGetGrpTz As Boolean
    'One group has three TZs,mesns tz1 or tz2 or tz3,not and
    bGetGrpTz = frm2.CZKEM1.GetGroupTZStr(CLng(frm2.txtMachNum.Text), CLng(cmbSGroupID.Text), TZS)
    If bGetGrpTz Then
        lsGrpTZ.AddItem "Group" & CStr(cmbSGroupID.Text) & "TZs-" & TZS
    End If
End Sub

Private Sub cmdGetTzInfo_Click()
    Dim bGTz As Boolean
    Dim tz As String
    Dim strTemp As String
    
    lstTz.Clear
    
    bGTz = frm2.CZKEM1.GetTZInfo(CLng(frm2.txtMachNum.Text), CLng(txtTzIndex.Text), tz)
    If bGTz Then
        'hebdomad
        For i = 0 To 6
            strTemp = week(i) & Mid(tz, i * 8 + 1, 4) & "-" & Mid(tz, i * 8 + 5, 4)
            lstTz.AddItem strTemp
        Next
    End If
End Sub

Private Sub cmdGetUnlockGrp_Click()
    Dim grps As String
    Dim bGetUnlocdGrp As Boolean
    Dim stemp As String
    Dim stemp1 As String
    Dim i As Long
    Dim j As Long
    
    bGetUnlocdGrp = frm2.CZKEM1.GetUnlockGroups(CLng(frm2.txtMachNum.Text), grps)
    
    If bGetUnlocdGrp Then
        j = 1
        '10 groups,partition by ':'
        For i = 1 To Len(grps)
            stemp1 = Mid(grps, i, 1)
            If stemp1 <> ":" Then
                stemp = stemp & stemp1
                If i = Len(grps) And j = 10 Then
                    lsUnlockGrp.AddItem "Groups 10" & " - " & stemp
                End If
            ElseIf stemp1 = ":" Then
                lsUnlockGrp.AddItem "Groups " & j & "" & " - " & stemp
                lsUnlockGrp.Refresh
                j = j + 1
                stemp = ""
                If i = Len(grps) Then
                    lsUnlockGrp.AddItem "Groups 10" & " - " & "  "
                End If
            End If
        Next
    End If
End Sub

Private Sub cmdGetUserTzInfo_Click()
    Dim TZS As String
    Dim bGetTZ As Boolean
    
    If IsNumeric(txtUserID) Then
        bGetTZ = frm2.CZKEM1.GetUserTZStr(CLng(frm2.txtMachNum.Text), CLng(txtUserID.Text), TZS)
        If bGetTZ Then
            lsUserTZ.AddItem "User  " & txtUserID.Text & " - " & TZS
        End If
    End If
End Sub

Private Sub cmdOpenDoor_Click()
    'Open a door controling by machine, the number is frm2.txtMachiNum.text
    frm2.CZKEM1.ACUnlock CLng(frm2.txtMachNum.Text), 100
End Sub

Private Sub cmdSetGroupStr_Click()
    Dim TZS
    Dim bSGrpTZ As Boolean
    
    TZS = txtGrpTZ1.Text & ":" & txtGrpTZ2.Text & ":" & txtGrpTZ3.Text
    
    bSGrpTZ = frm2.CZKEM1.SetGroupTZStr(CLng(frm2.txtMachNum.Text), CLng(cmbSGroupID.Text), TZS)
    If bSGrpTZ Then
        MsgBox "set group TZ successful", vbOKOnly, "Info"
    Else
        MsgBox "set group TZ fail", vbOKOnly, "Info"
    End If
End Sub

Private Sub cmdSetUnlockGroups_Click()
    Dim grps
    Dim bSetUnlockGrp As Boolean
    
    grps = txtGrp1.Text & ":" & txtGrp2.Text & ":" & txtGrp3.Text & ":" & txtGrp4.Text & ":" & txtGrp5.Text & ":"
    grps = grps & txtGrp6.Text & ":" & txtGrp7.Text & ":" & txtGrp8.Text & ":" & txtGrp9 & ":" & txtGrp10.Text
    
    bSetUnlockGrp = frm2.CZKEM1.SetUnlockGroups(CLng(frm2.txtMachNum.Text), grps)
    If bSetUnlockGrp Then
        MsgBox "Set unlock groups successful", vbOKOnly, "Info"
    Else
        MsgBox "Set unlock groups fail", vbOKOnly, "Info"
    End If
End Sub

Private Sub cmdSetUserGroup_Click()
    Dim bsetGp As Boolean
    
    bsetGp = frm2.CZKEM1.SetUserGroup(CLng(frm2.txtMachNum.Text), CLng(txtSUGID.Text), CLng(cmbGroupID.Text))
    If bsetGp Then
        MsgBox "set user group successful", vbOKOnly, "Info"
    Else
        MsgBox "set user group fail", vbOKOnly, "Info"
    End If
End Sub

Private Sub cmdSeuUserTzInfo_Click()
    Dim TZS
    Dim bSetTZ As Boolean
    
    If txtUserID.Text = "" Then Exit Sub
    If IsNumeric(txtUserID.Text) Then
        TZS = txtTZ1.Text & ":" & txtTZ2.Text & ":" & txtTZ3.Text
        bSetTZ = frm2.CZKEM1.SetUserTZStr(CLng(frm2.txtMachNum.Text), CLng(txtUserID.Text), TZS)
        If bSetTZ Then
            MsgBox "set user tz successful", vbOKOnly, "Info"
        Else
            MsgBox "set user tz fail", vbOKOnly, "info"
        End If
    End If
End Sub

Private Sub cmdTzInfo_Click()
    Dim strTime
    Dim bSetTZ As Boolean
    
    If txtTzIndex.Text = "" Then Exit Sub
    
    strTime = txt7.Text & txt77.Text & txt1.Text & txt11.Text & txt2.Text & txt22.Text & txt3.Text & txt33.Text & txt4.Text & txt44.Text
    strTime = strTime & txt5.Text & txt55.Text & txt6.Text & txt66.Text
    
    bSetTZ = frm2.CZKEM1.SetTZInfo(CLng(frm2.txtMachNum.Text), CLng(txtTzIndex.Text), strTime)
    If bSetTZ Then
        MsgBox "set TZ info successful!", vbOKOnly, "successful"
    Else
        MsgBox "set TZ info fail!", vbOKOnly, "fail"
    End If
End Sub
