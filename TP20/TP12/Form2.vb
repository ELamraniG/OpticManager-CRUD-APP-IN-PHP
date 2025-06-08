Public Class Form2
    Private Sub Form2_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Dim icone As New Icon("emp.ico") 'il faut placer emp.ico dans le dossier debug
        Me.Icon = icone
        Me.Text = "Formulaire Service "
        Me.MinimizeBox = False
        Me.MaximizeBox = False
        Me.CenterToScreen()
    End Sub

    Private Sub idservice_GotFocus(ByVal sender As Object, ByVal e As System.EventArgs) Handles idservice.GotFocus
        idservice.BackColor = Color.Cyan
        idservice.Font = New Font(idservice.Font.FontFamily, 12, FontStyle.Bold)
    End Sub

    Private Sub idservice_LostFocus(ByVal sender As Object, ByVal e As System.EventArgs) Handles idservice.LostFocus
        idservice.BackColor = Color.White
        idservice.Font = New Font(idservice.Font.FontFamily, 10, FontStyle.Regular)
    End Sub

    Private Sub nomservice_GotFocus(ByVal sender As Object, ByVal e As System.EventArgs) Handles nomservice.GotFocus
        nomservice.BackColor = Color.Cyan
        nomservice.Font = New Font(nomservice.Font.FontFamily, 12, FontStyle.Bold)
    End Sub

    Private Sub nomservice_LostFocus(ByVal sender As Object, ByVal e As System.EventArgs) Handles nomservice.LostFocus
        nomservice.BackColor = Color.White
        nomservice.Font = New Font(nomservice.Font.FontFamily, 10, FontStyle.Regular)
    End Sub

    Private Sub Save_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Save.Click
        connexion()
        If (type_operation.Text = "Ajouter") Then
            requete = "insert into service values ('" + idservice.Text + "','" + nomservice.Text + "')"
        Else
            requete = "update service set idservice='" + idservice.Text + "', " & _
                "nomservice = '" + nomservice.Text + "'" & _
                "where idservice = '" + ancien_idservice.Text + "'"
        End If
        cmdsql()
        Try
            cmd.ExecuteNonQuery() 'On exécute la requête
            con.Close()
            Form1.afficher_service()
            Me.Close()
        Catch ex As Exception
            MsgBox("Le ID service existe déjà, Veuillez le remplacer par un autre", vbExclamation, "Message")
            con.Close()
        End Try
    End Sub
End Class