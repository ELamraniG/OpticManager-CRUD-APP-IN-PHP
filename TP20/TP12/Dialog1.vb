Imports System.Windows.Forms
Imports System.IO

Public Class Dialog1

    Private Sub OK_Button_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles OK_Button.Click
        Me.DialogResult = System.Windows.Forms.DialogResult.OK
        Me.Close()
    End Sub

    Private Sub Cancel_Button_Click(ByVal sender As System.Object, ByVal e As System.EventArgs)
        Me.DialogResult = System.Windows.Forms.DialogResult.Cancel
        Me.Close()
    End Sub

    Private Sub Dialog1_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Me.Text = "Politique de confidentialité"
        ' Chemin du fichier texte
        Dim chemin As String = "aides/politique de confidentialité.txt"

        ' Vérifier si le fichier existe
        If File.Exists(chemin) Then
            ' Lire le contenu du fichier texte
            Dim content As String = File.ReadAllText(chemin)

            ' Afficher le contenu dans le TextBox
            TextBox1.Text = content
        Else
            MessageBox.Show("Le fichier texte n'existe pas.")
        End If
    End Sub
End Class
