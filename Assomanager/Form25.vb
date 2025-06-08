Imports System.Data.OleDb
Public Class menu

    Private Sub menu_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Dim icone As New Icon("images/emp.ico")
        Me.Icon = icone
        Me.Text = "Gestion de la paie du personnel d'une entreprise "
        Me.BackColor = Color.White
        Me.Width = 1200
        Me.Height = 600
        Me.WindowState = FormWindowState.Maximized
        Me.BackgroundImage = Image.FromFile("images/bg.jpg")
        Me.BackgroundImageLayout = ImageLayout.Stretch
        infos_entreprise()
        '' afficher_lespanels()
        desactiverlesacces()
        'Authentification
        panelauthentification.Left = (Me.Width - panelauthentification.Width) / 2
        panelauthentification.Top = (Me.Height - panelauthentification.Height) / 2

    End Sub
    Private Sub infos_entreprise()
        connexion()
        requete = "select * from parametres"
        Dim cmd As New OleDbCommand
        cmd.Connection = con
        cmd.CommandText = requete
        Dim data As IDataReader
        data = cmd.ExecuteReader()
        Dim sigle, nomentreprise As String
        sigle = ""
        nomentreprise = ""
        While data.Read()
            sigle = data(1)
            nomentreprise = data(2)
        End While
        con.Close()
        Label1.Left = (panelservice.Width - Label1.Width) / 2
        Label2.Left = (panelemploye.Width - Label2.Width) / 2
        Label3.Left = (panelaffectation.Width - Label3.Width) / 2

        tsigle.Text = sigle
        tnomentreprise.Text = nomentreprise
        tsigle.Left = (Me.Width - tsigle.Width) / 2
        tnomentreprise.Left = (Me.Width - tnomentreprise.Width) / 2
    End Sub
    Public Sub afficher_lespanels()
        connexion()
        'Panel de service
        requete = "select count(*) from services"
        cmdsql()
        Dim cpt As Integer = CInt(cmd.ExecuteScalar())
        cptservice.Text = cpt.ToString
        cptservice.Left = (panelservice.Width - cptservice.Width) / 2

        'Panel de employé
        requete = "select count(*) from employe"
        cmdsql()
        cpt = CInt(cmd.ExecuteScalar())
        cptemploye.Text = cpt.ToString
        cptemploye.Left = (panelemploye.Width - cptemploye.Width) / 2

        'Panel de affectation
        requete = "select count(*) from affecter"
        cmdsql()
        cpt = CInt(cmd.ExecuteScalar())
        cptaffectation.Text = cpt.ToString
        cptaffectation.Left = (panelaffectation.Width - cptaffectation.Width) / 2

        'Panel de pointage
        requete = "select count(*) from pointage, employe where pointage.idemploye = employe.idemploye"
        cmdsql()
        cpt = CInt(cmd.ExecuteScalar())


        'Panel des utilisateurs
        requete = "select count(*) from utilisateur"
        cmdsql()
        cpt = CInt(cmd.ExecuteScalar())
        cptutilisateur.Text = cpt.ToString
        cptutilisateur.Left = (panelutilisateur.Width - cptutilisateur.Width) / 2
        Label7.Left = (panelutilisateur.Width - cptutilisateur.Width) / 2
        con.Close()

        'Date et heure système
        paneldateheure.Left = Me.Width - paneldateheure.Width - 100
        Dim j As Integer = DateTime.Now.DayOfWeek
        Dim jour As String = ""
        If (j = 1) Then jour = "Lundi"
        If (j = 2) Then jour = "Mardi"
        If (j = 3) Then jour = "Mercredi"
        If (j = 4) Then jour = "Jeudi"
        If (j = 5) Then jour = "Vendredi"
        If (j = 6) Then jour = "Samedi"
        If (j = 7) Then jour = "Dimanche"
        joursysteme.Text = jour
        joursysteme.Left = (paneldateheure.Width - joursysteme.Width) / 2
        datesysteme.Text = DateTime.Now.Date
        datesysteme.Left = (paneldateheure.Width - datesysteme.Width) / 2
    End Sub
    Private Sub ToolStripButton6_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles ToolStripButton6.Click
        End
    End Sub

    Private Sub QuitterToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles QuitterToolStripMenuItem.Click
        End
    End Sub

    Private Sub service_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles service.Click, GestionDesServicesToolStripMenuItem.Click
        Dim myForm As New Form17()
        Form1.ShowDialog()
        ' afficher_lespanels()
    End Sub


    Private Sub employe_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles employe.Click, GestionDesEmployésToolStripMenuItem.Click
        Dim myForm As New Form17()
        myForm.ShowDialog()
        '' afficher_lespanels()
    End Sub


    Private Sub affecter_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles affecter.Click, AffecttationDeSemployésToolStripMenuItem.Click
        Dim myForm As New Form7()
        myForm.ShowDialog()
        '' afficher_lespanels()
    End Sub






    Private Sub Timer1_Tick(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Timer1.Tick
        heuresysteme.Text = DateTime.Now.ToString("HH:mm:ss")
        heuresysteme.Left = (paneldateheure.Width - heuresysteme.Width) / 2
    End Sub
    'Je crée une méthode pour pouvoir modifier les labels sigle et nomentreprise depuis la fenêtre paramêtre
    Public Sub modifier_parametre(ByVal sigle As String, ByVal nomEntreprise As String)
        tsigle.Text = sigle
        tnomentreprise.Text = nomEntreprise
        tsigle.Left = (Me.Width - tsigle.Width) / 2
        tnomentreprise.Left = (Me.Width - tnomentreprise.Width) / 2
    End Sub

    Private Sub EtatDesServicesToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles EtatDesServicesToolStripMenuItem.Click
        'Il faut afficher les données dans le datagrid afin de pourvoir les utiliser dans le printdocument du form correspondant
        'Ouvrir la fenêtre correspondate en la réduisant dans la barre des taches et sans l'afficher

        ' Créer une nouvelle instance de la fenêtre 
        Dim frm As New Form1()

        ' Masquer la fenêtre dans la barre des tâches
        frm.ShowInTaskbar = False

        ' Réduire la fenêtre
        frm.WindowState = FormWindowState.Minimized

        ' Afficher la fenêtre sans la rendre visible à l'utilisateur
        frm.Show()

        ' Appeler la méthode d'impression xxxx_Click pour imprimer 
        ' frm.ImprimerListeDesEmployésDunServiceToolStripMenuItem_Click(sender, e)

    End Sub

    Private Sub EtatDesEmployésParServiceToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles EtatDesEmployésParServiceToolStripMenuItem.Click
        Dim frm As New Form1()
        frm.ShowInTaskbar = False
        frm.WindowState = FormWindowState.Minimized
        frm.Show()
        ' frm.ImprimerHistoriqueDesAffectationsDunEmployéToolStripMenuItem_Click(sender, e)
    End Sub



    Private Sub Fermer_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Fermer.Click
        End
    End Sub

    Private Sub seconnecter_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles seconnecter.Click
        'Rechercher si le login et le mot de passe sont dans la table user
        requete = "select utilisateurs.*, nom, prenom from utilisateurs, employe where" & _
                " utilisateurs.idemploye = employe.idemploye " & _
                " and ucase(login) = '" + login.Text.ToUpper + "'" & _
                " and ucase(motdepasseutilisateur) = '" + motdepasse.Text.ToUpper + "'"
        connexion()
        cmdsql()
        Dim data As IDataReader
        data = cmd.ExecuteReader()
        Dim typeutilisateur As String = Nothing
        Dim menuorganisation As String = Nothing
        Dim gestiondesservices As String = Nothing
        Dim gestiondesemployes As String = Nothing
        Dim affectationdesemployes As String = Nothing
        Dim pointage As String = Nothing
        Dim pointageindividuel As String = Nothing
        Dim pointageautomatique As String = Nothing
        Dim rapport As String = Nothing
        Dim rapportdepointage As String = Nothing
        Dim lespointagesdunemploye As String = Nothing
        Dim lespointagesdunservice As String = Nothing
        Dim rapportdaffectation As String = Nothing
        Dim lesemployesdunservice As String = Nothing
        Dim lesaffectationdunemploye As String = Nothing
        Dim parametre As String = Nothing
        Dim gestiondesutilisateurs As String = Nothing
        Dim configurationdelapplication As String = Nothing
        Dim nom As String = Nothing
        Dim prenom As String = Nothing
        If data.Read() Then
            ' L'utilisateur existe, on récupère les informations
            typeutilisateur = data(4).ToString
            menuorganisation = data(5).ToString
            gestiondesservices = data(6).ToString
            gestiondesemployes = data(7).ToString
            affectationdesemployes = data(8).ToString
            pointage = data(9).ToString
            pointageindividuel = data(10).ToString
            pointageautomatique = data(11).ToString
            rapport = data(12).ToString
            rapportdepointage = data(13).ToString
            lespointagesdunemploye = data(14).ToString
            lespointagesdunservice = data(15).ToString
            rapportdaffectation = data(16).ToString
            lesemployesdunservice = data(17).ToString
            lesaffectationdunemploye = data(18).ToString
            parametre = data(19).ToString
            gestiondesutilisateurs = data(20).ToString
            configurationdelapplication = data(21).ToString
            nom = data(22).ToString
            prenom = data(23).ToString
            nomuser.Text = nom
            prenomuser.Text = prenom
            typeuser.Text = typeutilisateur
            nomuser.Left = (paneldateheure.Width - nomuser.Width) / 2
            prenomuser.Left = (paneldateheure.Width - prenomuser.Width) / 2
            typeuser.Left = (paneldateheure.Width - typeuser.Width) / 2
            If typeutilisateur = "admin" Then
                MenuStrip1.Enabled = True
                panelaffectation.Visible = True
                panelemploye.Visible = True
                panelservice.Visible = True
                panelutilisateur.Visible = True
                ToolStrip1.Visible = True
                ToolStrip1.Enabled = True
                barredoutils.Checked = True
                ToolStripStatusLabel2.Text = "ESPACE ADMINISTRATEUR"
            Else
                MenuStrip1.Enabled = True
                OrganisationToolStripMenuItem.Enabled = (menuorganisation = "1")
                GestionDesServicesToolStripMenuItem.Enabled = (gestiondesservices = "1")
                GestionDesEmployésToolStripMenuItem.Enabled = (gestiondesemployes = "1")
                AffecttationDeSemployésToolStripMenuItem.Enabled = (affectationdesemployes = "1")
                RapportsToolStripMenuItem.Enabled = (rapport = "1")
                RapportDaffectaionToolStripMenuItem.Enabled = (rapportdaffectation = "1")
                EtatDesServicesToolStripMenuItem.Enabled = (lesemployesdunservice = "1")
                EtatDesEmployésParServiceToolStripMenuItem.Enabled = (lesaffectationdunemploye = "1")
                ParamètresToolStripMenuItem.Enabled = (parametre = "1")
                GestionDesUtilisateursToolStripMenuItem.Enabled = (gestiondesutilisateurs = "1")
                ToolStripStatusLabel2.Text = "ESPACE " + typeutilisateur.ToUpper
            End If
            panelauthentification.Visible = False
        Else
            ' Aucune ligne retournée, affichage du message d'échec de connexion
            MessageBox.Show("Echec de connexion.", "Erreur", MessageBoxButtons.OK, MessageBoxIcon.Error)
            panelauthentification.Visible = True
        End If

        data.Close() ' Fermer le DataReader
        con.Close() ' Fermer la connexion à la base de données


    End Sub

    Private Sub DéconnecterToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles DéconnecterToolStripMenuItem.Click
        desactiverlesacces()
    End Sub
    Public Sub desactiverlesacces()
        'Desactiver les accès 
        Me.MenuStrip1.Enabled = False
        Me.ToolStrip1.Enabled = False
        Me.ToolStrip1.Visible = False
        panelaffectation.Visible = False
        panelemploye.Visible = False
        panelservice.Visible = False
        panelutilisateur.Visible = False
        nomuser.Text = Nothing
        prenomuser.Text = Nothing
        typeuser.Text = Nothing
        panelauthentification.Visible = True
    End Sub

    Private Sub GestionDesUtilisateursToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles GestionDesUtilisateursToolStripMenuItem.Click
        Form15.ShowDialog()
    End Sub

    Private Sub barredoutils_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles barredoutils.Click
        If (barredoutils.Checked = True) Then
            barredoutils.Checked = False
            ToolStrip1.Visible = False
        Else
            barredoutils.Checked = True
            ToolStrip1.Visible = True
        End If
    End Sub

    Private Sub PolitiqueDeConfidentialitéToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles PolitiqueDeConfidentialitéToolStripMenuItem.Click
        Form1.ShowDialog()

    End Sub

    Private Sub ConditionsDutilisationToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles ConditionsDutilisationToolStripMenuItem.Click
        On Error Resume Next
        Form1.ShowDialog()

    End Sub

    Private Sub AProposToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles AProposToolStripMenuItem.Click
        Form1.ShowDialog()
    End Sub

    Private Sub AideEnLigneToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles AideEnLigneToolStripMenuItem.Click
        Form1.ShowDialog()

    End Sub

    Private Sub TutorielsVidéoToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles TutorielsVidéoToolStripMenuItem.Click
        Form1.ShowDialog()

    End Sub

    Private Sub cptpointage_Click(ByVal sender As System.Object, ByVal e As System.EventArgs)

    End Sub

    Private Sub PointageAutomatiqueToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs)

    End Sub

    Private Sub LesPointagesDunEmployéToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs)

    End Sub

    Private Sub LesPointagesDunServiceToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs)

    End Sub

    Private Sub RapportDaffectaionToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles RapportDaffectaionToolStripMenuItem.Click

    End Sub

    Private Sub pauto_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles pauto.Click

    End Sub

    Private Sub AccueilToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles AccueilToolStripMenuItem.Click

    End Sub

    Private Sub AideToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles AideToolStripMenuItem.Click

    End Sub
End Class