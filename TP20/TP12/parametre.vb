Imports System.Data.OleDb
Public Class parametre

    Private Sub parametre_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Dim icone As New Icon("images/emp.ico")
        Me.Icon = icone
        Me.Text = "Configuration de l'application"
        Me.BackColor = Color.White
        Me.MinimizeBox = False
        Me.MaximizeBox = False
        Me.Width = 300
        Me.Height = 300
        Me.CenterToScreen()

        'Récuperer les données de la table parametre
        connexion()
        requete = "select * from parametre"
        Dim cmd As New OleDbCommand
        cmd.Connection = con
        cmd.CommandText = requete
        Dim data As IDataReader
        data = cmd.ExecuteReader()
        Dim sigle As String = ""
        Dim nomentreprise As String = ""
        Dim heuredentree As String = ""
        Dim heuredesortie As String = ""
        While data.Read()
            sigle = data(1)
            nomentreprise = data(2)
            heuredentree = data(3)
            heuredesortie = data(4)
        End While
        con.Close()
        'Fin ----------------------
        'Charchement des donnnées dans les champs
        tsigle.Text = sigle
        tnomentreprise.Text = nomentreprise
        dtp1.Format = DateTimePickerFormat.Time 'dtp : datetimepicker | Le format = time 
        dtp1.ShowUpDown = True 'Pour affiher les boutons pour augumenter/diminuer l'heure
        dtp2.Format = DateTimePickerFormat.Time
        dtp2.ShowUpDown = True
        dtp1.Text = heuredentree
        dtp2.Text = heuredesortie
        'Fin ---------------------
    End Sub

    Private Sub Enregistrer_Click_1(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Enregistrer.Click
        'Sauvegarder les nouveaux paramètres
        requete = "update parametre set "
        requete += "sigle = '" + tsigle.Text + "'"
        requete += ", nomentreprise = '" + tnomentreprise.Text + "'"
        requete += ", heuredentree = '" + dtp1.Text + "'"
        requete += ", heuredesortie = '" + dtp2.Text + "'"
        connexion()
        cmdsql()
        cmd.ExecuteNonQuery()
        con.Close()
        'Fin ----------------------
        'Mettre à jour les Labels correspondants aux données de l'entreprise
        Dim frm As menu = CType(Application.OpenForms("menu"), menu) 'Application.OpenForms("menu") est une méthode qui renvoie une référence 
        'à une fenêtre ouverte dans l'application avec le nom spécifié entre parenthèses ("menu" dans ce cas).
        frm.modifier_parametre(tsigle.Text, tnomentreprise.Text) 'On utilise une méthode modifier_parametre(les arguments) 
        Me.Close()
    End Sub
End Class