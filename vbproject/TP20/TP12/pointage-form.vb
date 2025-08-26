Public Class pointage_form

    Private Sub pointage_form_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Dim icone As New Icon("images/emp.ico")
        Me.Icon = icone
        Me.Text = "Formulaire de pointage "
        Me.MinimizeBox = False
        Me.MaximizeBox = False
        Me.CenterToScreen()

        'Remplir le combo des employés
        connexion()
        requete = "select * from employe where idemploye order by nom"
        cmdsql()
        Dim datae As IDataReader
        datae = cmd.ExecuteReader()
        Dim ide, nome, prenome As String
        idemploye.Items.Clear()
        While datae.Read()
            ide = datae(0).ToString
            nome = datae(3)
            prenome = datae(4)
            idemploye.Items.Add(ide + " | " + nome + " " + prenome)
        End While
        con.Close()
        'Recherche de l'heure d'entree et de sortie dans la table paramêtre
        connexion()
        requete = "select * from parametre"
        cmdsql()
        Dim data As IDataReader
        data = cmd.ExecuteReader()
        Dim heuredentree As String = ""
        Dim heuredesortie As String = ""
        While data.Read()
            heuredentree = data(3)
            heuredesortie = data(4)
        End While
        heureentree.Text = heuredentree
        heuresortie.Text = heuredesortie
        heureentree.ShowUpDown = True
        heuresortie.ShowUpDown = True
        con.Close()
    End Sub

    Private Sub Button1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button1.Click
        Dim p As Integer
        Dim ide As String = 0
        If (idemploye.SelectedIndex <> -1) Then
            p = InStr(idemploye.Text, "|")
            ide = Mid(idemploye.Text, 1, p - 1)
        End If
        If type_operation.Text = "Modifier" Then
            p = InStr(idemploye.Text, "|")
            ide = Mid(idemploye.Text, 1, p - 1)

            requete = "update pointage set idemploye = " + ide + ", " & _
                " datepointage = '" + datepointage.Text + "', " & _
                " heureentree = '" + heureentree.Text + "', " & _
                " heuresortie = '" + heuresortie.Text + "', " & _
                " typepointage = '" + typepointage.Text + "', " & _
                " notes = '" + notes.Text + "' " & _
                " where num = " + ancien_idpointage.Text
        End If
        If type_operation.Text = "Ajouter" Then
            requete = "insert into pointage(idemploye, datepointage, heureentree, heuresortie, typepointage, notes) " & _
                " values (" + ide & _
                ", '" + datepointage.Text & _
                "', '" + heureentree.Text & _
                "', '" + heuresortie.Text & _
                "', '" + typepointage.Text & _
                "', '" + notes.Text + "')"
        End If

        connexion()
        cmdsql()
        cmd.ExecuteNonQuery()
        con.Close()
        pointage.afficher_pointage()
        Me.Close()
    End Sub

    
End Class