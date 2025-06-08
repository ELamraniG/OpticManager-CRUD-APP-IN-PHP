Imports System.Data.OleDb
Public Class pointageautomatique

    Private Sub pointageautomatique_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Dim icone As New Icon("images/emp.ico")
        Me.Icon = icone
        Me.Text = "Pointage automatique... "
        Me.BackColor = Color.White
        Me.Width = 400
        Me.Height = 300
        Me.CenterToScreen()
        Me.datedepointage.Format = DateTimePickerFormat.Custom
        Me.datedepointage.CustomFormat = "dd-MM-yyyy"
        Me.datedepointage.Value = Date.Today
        ProgressBar1.Width = Me.Width
    End Sub

    Private Sub Button1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button1.Click

        Dim result As DialogResult = MessageBox.Show("Voulez-vous vraiment effectuer cette action ?", "Confirmation", MessageBoxButtons.YesNo, MessageBoxIcon.Question)
        ProgressBar1.Value = 10
        If result = DialogResult.Yes Then
            Timer1.Start()

            'Définition des données à ajouter par défaut
            Dim ide, ddp, he, hs, tp, nt As String
            ddp = Me.datedepointage.Text
            he = "9:00"
            hs = "16:00"
            tp = "REGULIER"
            nt = ""
            'Parcourir les id des employés
            connexion()
            Dim requete_employe As String
            requete_employe = "select * from employe order by idemploye"
            Dim cmd As New OleDbCommand
            cmd.Connection = con
            cmd.CommandText = requete_employe
            Dim data As IDataReader
            data = cmd.ExecuteReader()
            cmd2.Connection = con
            While data.Read()
                ide = data(0).ToString
                'Création de la requête d'insertion dans la table pointage
                requete = "insert into pointage(idemploye, datepointage, heureentree, heuresortie, typepointage, notes) " & _
                " values (" + ide & _
                ", '" + ddp & _
                "', '" + he & _
                "', '" + hs & _
                "', '" + tp & _
                "', '" + nt + "')"
                cmd2.CommandText = requete
                cmd2.ExecuteNonQuery()
            End While

            con.Close()
            Timer1.Stop()
            Me.Close()
            'Ouverture de la fenêtre de pointage
            Dim myForm As New pointage()
            myForm.Show()
        End If

    End Sub

    Private Sub Timer1_Tick(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Timer1.Tick
        While (ProgressBar1.Value < ProgressBar1.Maximum)
            ProgressBar1.Value = ProgressBar1.Value + 10
        End While

    End Sub
End Class