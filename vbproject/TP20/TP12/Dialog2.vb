Imports System.Windows.Forms

Public Class Dialog2

    Private Sub OK_Button_Click(ByVal sender As System.Object, ByVal e As System.EventArgs)
        Me.DialogResult = System.Windows.Forms.DialogResult.OK
        Me.Close()
    End Sub

    Private Sub Cancel_Button_Click(ByVal sender As System.Object, ByVal e As System.EventArgs)
        Me.DialogResult = System.Windows.Forms.DialogResult.Cancel
        Me.Close()
    End Sub

    Private Sub Dialog2_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Me.Width = 1000
        Me.Height = 500
        AxAcroPDF1.Width = Me.Width
        'Définir le zoom de la page pdf
        AxAcroPDF1.setZoom(90)
        'Afficher en une seule page (3)
        AxAcroPDF1.setView(3)
        'Afficher la barre d'outils de PDF Reader
        AxAcroPDF1.setShowToolbar(True)
        'Afficher les scrollbars
        AxAcroPDF1.setShowScrollbars(True)
        'Afficher en utilisant les signets
        AxAcroPDF1.setPageMode(1)

        Dim filePath As String = "aides/conditionsdutilisations.pdf"

        ' Vérifiez que le fichier PDF existe
        If System.IO.File.Exists(filePath) Then
            ' Chargez le fichier PDF dans le contrôle AxAcroPDF
            AxAcroPDF1.LoadFile(filePath)
        Else
            MessageBox.Show("Le fichier PDF n'a pas été trouvé.")
        End If
    End Sub
End Class
