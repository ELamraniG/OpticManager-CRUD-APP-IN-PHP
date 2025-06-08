Imports System.Windows.Forms
Imports System.IO

Public Class Dialog4

    Private Sub OK_Button_Click(ByVal sender As System.Object, ByVal e As System.EventArgs)
        Me.DialogResult = System.Windows.Forms.DialogResult.OK
        Me.Close()
    End Sub

    Private Sub Cancel_Button_Click(ByVal sender As System.Object, ByVal e As System.EventArgs)
        Me.DialogResult = System.Windows.Forms.DialogResult.Cancel
        Me.Close()
    End Sub

    Private Sub Dialog4_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Me.Width = 1000
        Me.Height = 600
        Me.StartPosition = FormStartPosition.CenterScreen
        AxWindowsMediaPlayer1.Width = Me.Width - 50
        AxWindowsMediaPlayer1.Height = Me.Height - 50
        Me.Text = "Tutorial de LaPduP"

        Dim chemin As String = Path.Combine(Application.StartupPath, "aides\tutorial\tutorial.mp4")
        AxWindowsMediaPlayer1.uiMode = "full"
        AxWindowsMediaPlayer1.enableContextMenu = True

        AxWindowsMediaPlayer1.URL = chemin

    End Sub
End Class
