Imports System.Data.OleDb
Imports System.Security.Cryptography
Imports System.Text
Imports System.Drawing.Printing

Public Class employe
    Private Sub employe_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Dim icone As New Icon("images/emp.ico")
        Me.Icon = icone
        Me.Text = "Gestion des employés "
        Me.BackColor = Color.White
        Me.Width = 1200
        Me.Height = 600
        Me.MaximizeBox = False
        Me.MinimizeBox = False
        Me.CenterToScreen()
        DataGridView1.Width = Me.Width - 35
        DataGridView1.Height = Me.Height - 120
        DataGridView1.BorderStyle = BorderStyle.None
        DataGridView1.DefaultCellStyle.Font = New Font("Arial", 8)
        'DataGridView1.AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill
        DataGridView1.ColumnHeadersDefaultCellStyle.BackColor = Color.Cyan
        DataGridView1.EnableHeadersVisualStyles = False
        DataGridView1.AlternatingRowsDefaultCellStyle.BackColor = Color.LightCyan
        DataGridView1.CellBorderStyle = DataGridViewCellBorderStyle.None
        DataGridView1.RowTemplate.Height = 40
        message.Visible = False
        tout.Visible = False
        requete = "select * from employe order by idemploye"
        tout.Text = 1
        afficher_employe(requete)
    End Sub

    Public Sub afficher_employe(ByRef requete As String)
        DataGridView1.Rows.Clear()
        DataGridView1.Columns.Clear()
        Dim id, ncin, nom, prenom, adresse, tel, email, ddn, ddr, fonction, specialite, salairenet, motdepasse As New DataGridViewTextBoxColumn()
        Dim photo As New DataGridViewImageColumn()
        id.HeaderText = "Id"
        id.Name = "idemploye"
        id.Width = 40
        DataGridView1.Columns.Add(id)

        photo.HeaderText = "Photo"
        photo.Name = "photo"
        photo.ImageLayout = DataGridViewImageCellLayout.Stretch
        photo.Width = 50
        DataGridView1.Columns.Add(photo)

        ncin.HeaderText = "ncin"
        ncin.Name = "ncin"
        DataGridView1.Columns.Add(ncin)
        ncin.Width = 60

        nom.HeaderText = "Nom"
        nom.Name = "Nom"
        DataGridView1.Columns.Add(nom)
        nom.AutoSizeMode = DataGridViewAutoSizeColumnMode.AllCells

        prenom.HeaderText = "Prénom"
        prenom.Name = "prenom"
        DataGridView1.Columns.Add(prenom)
        prenom.AutoSizeMode = DataGridViewAutoSizeColumnMode.AllCells

        adresse.HeaderText = "Adresse"
        adresse.Name = "adresse"
        DataGridView1.Columns.Add(adresse)
        adresse.AutoSizeMode = DataGridViewAutoSizeColumnMode.AllCells

        tel.HeaderText = "Tél"
        tel.Name = "tel"
        DataGridView1.Columns.Add(tel)
        tel.AutoSizeMode = DataGridViewAutoSizeColumnMode.AllCells

        email.HeaderText = "Email"
        adresse.Name = "email"
        DataGridView1.Columns.Add(email)
        email.AutoSizeMode = DataGridViewAutoSizeColumnMode.AllCells

        ddn.HeaderText = "Date de naissance"
        ddn.Name = "ddn"
        DataGridView1.Columns.Add(ddn)
        ddn.Width = 70

        ddr.HeaderText = "Date de recrutement"
        ddr.Name = "ddr"
        DataGridView1.Columns.Add(ddr)
        ddr.Width = 70

        fonction.HeaderText = "Fonction"
        fonction.Name = "fonction"
        DataGridView1.Columns.Add(fonction)
        fonction.AutoSizeMode = DataGridViewAutoSizeColumnMode.AllCells

        specialite.HeaderText = "Spécialité"
        specialite.Name = "specialite"
        DataGridView1.Columns.Add(specialite)
        specialite.AutoSizeMode = DataGridViewAutoSizeColumnMode.AllCells

        salairenet.HeaderText = "Salaire Net"
        salairenet.Name = "salairenet"
        DataGridView1.Columns.Add(salairenet)
        salairenet.AutoSizeMode = DataGridViewAutoSizeColumnMode.AllCells

        motdepasse.HeaderText = "Mot de passe"
        motdepasse.Name = "motdepasse"
        DataGridView1.Columns.Add(motdepasse)
        motdepasse.AutoSizeMode = DataGridViewAutoSizeColumnMode.AllCells
        connexion()
        cmdsql()
        Dim data As IDataReader
        data = cmd.ExecuteReader()
        Dim ids, photos, ncins, noms, prenoms, adresses, tels, emails, ddns, ddrs, fonctions, specialites, salairenets, motdepasses As String
        Dim pic As Image
        While data.Read()
            ids = data(0).ToString
            photos = data(1)
            ncins = data(2)
            noms = data(3)
            prenoms = data(4)
            adresses = data(5)
            tels = data(6)
            emails = data(7)
            ddns = data(8)
            ddrs = data(9)
            fonctions = data(10)
            specialites = data(11)
            salairenets = data(12)
            motdepasses = data(13)
            Dim chemin As String = "images/" + photos
            pic = Image.FromFile(chemin)
            DataGridView1.Rows.Add(ids, pic, ncins, noms, prenoms, adresses, tels, emails, ddns, ddrs, fonctions, specialites, salairenets, motdepasses)
        End While
        Dim nombre As Integer = DataGridView1.Rows.Count
        cpt.Text = "Nombre d'employés : " + nombre.ToString
        If (DataGridView1.Rows.Count = 0) Then
            MsgBox("Donnée INTROUVABLE...", MsgBoxStyle.Information, "Message")
        Else
            DataGridView1.FirstDisplayedScrollingRowIndex = DataGridView1.Rows.Count - 1
            If (Employe_form.type_operation.Text = "Ajouter") Then
                DataGridView1.FirstDisplayedScrollingRowIndex = DataGridView1.Rows.Count - 1
                'DataGridView1.Rows(DataGridView1.Rows.Count - 1).Selected = True
            End If
            If (Employe_form.type_operation.Text = "Modifier") Then
                DataGridView1.Rows(Val(Employe_form.ligne_modifie.Text)).Selected = True
            End If
        End If
        con.Close()
    End Sub

    Private Sub DataGridView1_CellDoubleClick(ByVal sender As Object, ByVal e As System.Windows.Forms.DataGridViewCellEventArgs) Handles DataGridView1.CellDoubleClick
        Dim i As Integer
        i = DataGridView1.CurrentCell.RowIndex
        Employe_form.Idemploye.Text = DataGridView1.Rows(i).Cells(0).Value
        Employe_form.ancien_idemploye.Text = Employe_form.Idemploye.Text

        Employe_form.ncin.Text = DataGridView1.Rows(i).Cells(2).Value
        Employe_form.nomemploye.Text = DataGridView1.Rows(i).Cells(3).Value
        Employe_form.prenom.Text = DataGridView1.Rows(i).Cells(4).Value
        Employe_form.adresse.Text = DataGridView1.Rows(i).Cells(5).Value
        Employe_form.tel.Text = DataGridView1.Rows(i).Cells(6).Value
        Employe_form.email.Text = DataGridView1.Rows(i).Cells(7).Value
        Employe_form.ddn.Text = DataGridView1.Rows(i).Cells(8).Value
        Employe_form.ddr.Text = DataGridView1.Rows(i).Cells(9).Value
        Employe_form.fonction.Text = DataGridView1.Rows(i).Cells(10).Value
        Employe_form.specialite.Text = DataGridView1.Rows(i).Cells(11).Value
        Employe_form.salairenet.Text = DataGridView1.Rows(i).Cells(12).Value
        'Employe_form.mdp.Text = Nothing
        'Employe_form.mdp_confirm.Text = Nothing
        Employe_form.PictureBox1.Image = DataGridView1.Rows(i).Cells(1).Value

        Employe_form.ligne_modifie.Text = i
        Employe_form.type_operation.Text = "Modifier"
        Employe_form.ShowDialog()
        requete = "select * from employe order by idemploye"
        tout.Text = 1
        afficher_employe(requete)

    End Sub



    Private Sub PrintDocument1_PrintPage(ByVal sender As System.Object, ByVal e As System.Drawing.Printing.PrintPageEventArgs) Handles PrintDocument1.PrintPage
        Dim font_titre As New Font("Arial", 12, FontStyle.Regular)
        Dim font_tcolonne As New Font("Arial", 10, FontStyle.Bold)
        Dim font_colonne As New Font("Arial", 10, FontStyle.Regular)
        Dim font_petitetaille As New Font("Arial", 8, FontStyle.Regular)
        Dim ln As Integer = 50
        Dim cl As Integer = 50
        Dim imageToPrint As Image = Image.FromFile("images/logo.png")
        e.Graphics.DrawImage(imageToPrint, 40, 40, 40, 40)
        e.Graphics.DrawString("La Paie du Personnel", font_petitetaille, Brushes.Black, 85, ln)
        e.Graphics.DrawString("Liste des employés", font_titre, Brushes.Black, 334, 80)
        Dim ligne As New Pen(Color.Black, 0.1)
        ln = ln + 80
        With e.Graphics
            .DrawString("Id ", font_tcolonne, Brushes.Black, cl, ln)
            .DrawString("Nom", font_tcolonne, Brushes.Black, cl + 40, ln)
            .DrawString("Préom", font_tcolonne, Brushes.Black, cl + 140, ln)
            .DrawString("Tél", font_tcolonne, Brushes.Black, cl + 240, ln)
            .DrawString("DDR", font_tcolonne, Brushes.Black, cl + 340, ln)
            .DrawString("Fonction", font_tcolonne, Brushes.Black, cl + 440, ln)
            .DrawString("Salaire Net", font_tcolonne, Brushes.Black, cl + 640, ln)
        End With
        ln = ln + 20
        e.Graphics.DrawLine(ligne, cl, ln, 780, ln)
        Dim c1, c2, c3, c4, c5, c6, c7 As String
        For i = 0 To DataGridView1.Rows.Count - 1
            c1 = DataGridView1.Rows(i).Cells(0).Value
            c2 = DataGridView1.Rows(i).Cells(3).Value
            c3 = DataGridView1.Rows(i).Cells(4).Value
            c4 = DataGridView1.Rows(i).Cells(6).Value
            c5 = DataGridView1.Rows(i).Cells(9).Value
            c6 = DataGridView1.Rows(i).Cells(10).Value
            c7 = DataGridView1.Rows(i).Cells(12).Value
            With e.Graphics
                .DrawString(c1, font_colonne, Brushes.Black, cl, ln)
                .DrawString(c2, font_colonne, Brushes.Black, cl + 40, ln)
                .DrawString(c3, font_colonne, Brushes.Black, cl + 140, ln)
                .DrawString(c4, font_colonne, Brushes.Black, cl + 240, ln)
                .DrawString(c5, font_colonne, Brushes.Black, cl + 340, ln)
                .DrawString(c6, font_colonne, Brushes.Black, cl + 440, ln)
                .DrawString(c7, font_colonne, Brushes.Black, cl + 640, ln)
            End With
            ln = ln + 20
            'e.Graphics.DrawLine(ligne, cl, ln, 780, ln)
        Next
        e.Graphics.DrawLine(ligne, cl, 1100, 780, 1100)
        e.Graphics.DrawString("Entreprise : Liste des employés ", font_petitetaille, Brushes.Black, cl, 1100)
    End Sub


    Private Sub Ajouter_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles ajouter.Click
        With Employe_form
            .type_operation.Text = "Ajouter"
            .Idemploye.Text = Nothing
            .anc_nom.Text = Nothing
            .ncin.Text = Nothing
            .nomemploye.Text = Nothing
            .prenom.Text = Nothing
            .adresse.Text = Nothing
            .tel.Text = Nothing
            .email.Text = Nothing
            .ddr.Text = Nothing
            .ddr.Text = Nothing
            .fonction.Text = Nothing
            .specialite.Text = Nothing
            .salairenet.Text = 0
            '.mdp.Text = Nothing
            '.mdp_confirm.Text = Nothing
        End With
        Employe_form.ShowDialog()
        requete = "select * from employe order by idemploye"
        tout.Text = 1
        afficher_employe(requete)

    End Sub

    Private Sub Actualiser_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Actualiser.Click
        If (tout.Text <> "1") Then
            requete = "select * from employe order by idemploye"
            afficher_employe(requete)
            tout.Text = "1"
            message.Visible = False
        End If
    End Sub

    Private Sub Supprimer_Click_1(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Supprimer.Click
        Employe_form.type_operation.Text = "Ajouter"
        If (DataGridView1.Rows.Count = 0) Then
            MsgBox("Aucun Employé...", vbExclamation, "Message")
        Else
            Dim i As Integer = DataGridView1.CurrentCell.RowIndex
            Dim id As String = DataGridView1.Rows(i).Cells(0).Value
            Dim rep As MsgBoxResult
            rep = MsgBox("Etes-vous sûr de supprimer cet employé : " + id + "? ", vbYesNo + vbQuestion, "Confirmation")
            If (rep = vbYes) Then
                connexion()
                requete = "delete from employe where idemploye = " + id
                cmdsql()
                cmd.ExecuteNonQuery()
                con.Close()
                requete = "select * from employe order by idemploye"
                afficher_employe(requete)
            End If
        End If
    End Sub

    Private Sub Rechercher_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Rechercher.Click
        tout.Text = "0"
        Dim nom_a_chercher As String
        nom_a_chercher = InputBox("Entrez le texte à chercher : ", "Recherche", "")
        If Not String.IsNullOrEmpty(nom_a_chercher) Then
            requete = "select * from employe where " & _
                "ucase(nom) like '%" + nom_a_chercher.ToUpper + "%'" & _
                "or ucase(prenom) like '%" + nom_a_chercher.ToUpper + "%'" & _
                "or ucase(adresse) like '%" + nom_a_chercher.ToUpper + "%'" & _
                "or ucase(tel) like '%" + nom_a_chercher.ToUpper + "%'" & _
                "or ucase(email) like '%" + nom_a_chercher.ToUpper + "%'" & _
                "or ucase(datedenaissance) like '%" + nom_a_chercher.ToUpper + "%'" & _
                "or ucase(datederecrutement) like '%" + nom_a_chercher.ToUpper + "%'" & _
                "or ucase(fonction) like '%" + nom_a_chercher.ToUpper + "%'" & _
                "or ucase(specialite) like '%" + nom_a_chercher.ToUpper + "%'" & _
                "or ucase(salairenet) like '%" + nom_a_chercher.ToUpper + "%'"

            afficher_employe(requete)
            message.Text = "Cliquez sur Actualiser pour tout afficher..."
            message.Visible = True
        End If
    End Sub

    Private Sub ImprimerTousLesServicesToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles ImprimerTousLesServicesToolStripMenuItem.Click
        DirectCast(PrintPreviewDialog1, Form).WindowState = FormWindowState.Maximized
        PrintDocument1.DefaultPageSettings.Landscape = False
        PrintPreviewDialog1.ShowDialog()
    End Sub

  
    Private Sub DataGridView1_CellContentClick(ByVal sender As System.Object, ByVal e As System.Windows.Forms.DataGridViewCellEventArgs) Handles DataGridView1.CellContentClick

    End Sub

    Private Sub ToolStripButton1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles ToolStripButton1.Click
        Me.Close()
    End Sub
End Class
