Imports System.Data.OleDb

Public Class pointage
    Public etat As Integer
    Private Sub pointage_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Dim icone As New Icon("images/emp.ico")
        Me.Icon = icone
        Me.Text = "Gestion des pointages "
        Me.BackColor = Color.White
        Me.Width = 1200
        Me.Height = 600
        Me.CenterToScreen()
        DataGridView1.Width = Me.Width - 40
        DataGridView1.Height = Me.Height - 100
        DataGridView1.BorderStyle = BorderStyle.None
        DataGridView1.DefaultCellStyle.Font = New Font("Arial", 10)
        DataGridView1.AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill
        DataGridView1.ColumnHeadersDefaultCellStyle.BackColor = Color.Cyan
        DataGridView1.EnableHeadersVisualStyles = False
        DataGridView1.AlternatingRowsDefaultCellStyle.BackColor = Color.LightCyan
        DataGridView1.CellBorderStyle = DataGridViewCellBorderStyle.None

        afficher_pointage()
    End Sub
    Public Sub afficher_pointage()
        connexion()
        requete = "select num, pointage.idemploye, nom, prenom, datepointage, left(right(heureentree,8), 5) as Arrivée, " & _
            "left(right(heuresortie, 8),5) as Départ, typepointage, notes " & _
            "from pointage, employe " & _
            "where pointage.idemploye = employe.idemploye order by datepointage desc"
        Try
            Dim da As New OleDbDataAdapter
            da = New OleDbDataAdapter(requete, con)
            Dim dt As New DataTable
            Dim ds As New DataSet
            da.Fill(dt)
            DataGridView1.DataSource = dt.DefaultView
            DataGridView1.Columns(0).Width = 100
            con.Close()
            Dim nombre As Integer = DataGridView1.Rows.Count
            cpt.Text = "Nombre de pointages : " + nombre.ToString
        Catch ex As Exception
            ' Gestion de l'erreur
            MessageBox.Show("La table est vide...", "Message", MessageBoxButtons.OK, MessageBoxIcon.Information)
            con.Close() ' Fermez la connexion en cas d'erreur
        End Try

    End Sub

    Private Sub Ajouter_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Ajouter.Click
        pointage_form.type_operation.Text = "Ajouter"
        'Initialiser le formulaire pour l'ajout
        pointage_form.idemploye.Text = Nothing
        pointage_form.datepointage.Text = Date.Now
        pointage_form.heureentree.Text = "09:00"
        pointage_form.heuresortie.Text = "15:00"
        pointage_form.typepointage.Text = "REGULIER"
        pointage_form.notes.Text = Nothing

        pointage_form.ShowDialog()
        afficher_pointage()
    End Sub
    Private Sub DataGridView1_CellDoubleClick(ByVal sender As Object, ByVal e As System.Windows.Forms.DataGridViewCellEventArgs) Handles DataGridView1.CellDoubleClick
        Dim i As Integer
        i = DataGridView1.CurrentCell.RowIndex
        'Remplir le combo employé par le id, le nom et prénom
        Dim txt As String = DataGridView1.Rows(i).Cells(1).Value.ToString + " | " + DataGridView1.Rows(i).Cells(2).Value + " " + DataGridView1.Rows(i).Cells(3).Value
        pointage_form.idemploye.Text = txt

        'Remplir le formulaire par les autres données de la ligne à modifier
        pointage_form.datepointage.Text = DataGridView1.Rows(i).Cells(4).Value.ToString
        pointage_form.heureentree.Text = DataGridView1.Rows(i).Cells(5).Value
        pointage_form.heuresortie.Text = DataGridView1.Rows(i).Cells(6).Value
        pointage_form.typepointage.Text = DataGridView1.Rows(i).Cells(7).Value.ToString
        pointage_form.notes.Text = DataGridView1.Rows(i).Cells(8).Value.ToString

        'Pour aider la requête de update à s'exécuter
        pointage_form.ancien_idpointage.Text = DataGridView1.Rows(i).Cells(0).Value.ToString
        pointage_form.ligne_modifie.Text = i
        pointage_form.type_operation.Text = "Modifier"
        pointage_form.ShowDialog()
        afficher_pointage()
    End Sub

    Private Sub Supprimer_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Supprimer.Click
        affecter_form.type_operation.Text = "Ajouter"
        If (DataGridView1.Rows.Count = 0) Then
            MsgBox("Aucun pointage...", vbExclamation, "Message")
        Else
            Dim i As Integer = DataGridView1.CurrentCell.RowIndex
            Dim idp As String = DataGridView1.Rows(i).Cells(0).Value
            Dim rep As MsgBoxResult
            rep = MsgBox("Etes-vous sûr de vouloir supprimer ce pointage ? ", vbYesNo + vbQuestion, "Confirmation")
            If (rep = vbYes) Then
                connexion()
                requete = "delete from pointage where num = " + idp
                cmdsql()
                cmd.ExecuteNonQuery()
                con.Close()
                afficher_pointage()
            End If
        End If
    End Sub

    Private Sub Rechercher_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Rechercher.Click
        Dim txt_achercher As String
        txt_achercher = InputBox("Entrez le nom ou le prénom ou la date de pointage à chercher : ", "Recherche", "")
        connexion()
        requete = "select num, pointage.idemploye, nom, prenom, datepointage, left(right(heureentree,8), 5) as Arrivée, " & _
           "left(right(heuresortie, 8),5) as Départ, typepointage, notes " & _
           "from pointage, employe " & _
           "where pointage.idemploye = employe.idemploye " & _
           "and (nom+prenom like '%" + txt_achercher + "%' or datepointage like '%" + txt_achercher + "%')"
        Dim da = New OleDbDataAdapter(requete, con)
        Dim dt As New DataTable
        Dim ds As New DataSet
        da.Fill(dt)
        DataGridView1.DataSource = dt.DefaultView
        DataGridView1.Columns(0).Width = 100
        con.Close()
        If (DataGridView1.Rows.Count = 0) Then MsgBox("Introuvable...", vbExclamation, "Message")
    End Sub

    Private Sub Actualiser_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Actualiser.Click
        afficher_pointage()
    End Sub

    Private Sub ImprimerTousLesServicesToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles ImprimerTousLesServicesToolStripMenuItem.Click
        etat = 1
        DirectCast(PrintPreviewDialog1, Form).WindowState = FormWindowState.Maximized
        PrintDocument1.DefaultPageSettings.Landscape = False
        PrintPreviewDialog1.ShowDialog()
    End Sub

    Private currentPage As Integer = 1 ' Variable pour suivre le numéro de page

    Private Sub PrintDocument1_BeginPrint(ByVal sender As Object, ByVal e As System.Drawing.Printing.PrintEventArgs) Handles PrintDocument1.BeginPrint
        currentPage = 1 ' Réinitialiser le numéro de page à chaque impression
    End Sub

    Private Sub PrintDocument1_PrintPage(ByVal sender As System.Object, ByVal e As System.Drawing.Printing.PrintPageEventArgs) Handles PrintDocument1.PrintPage
        Dim font_titre As New Font("Arial", 12, FontStyle.Regular)
        Dim font_tcolonne As New Font("Arial", 10, FontStyle.Bold)
        Dim font_colonne As New Font("Arial", 10, FontStyle.Regular)
        Dim ln As Integer = 50
        Dim cl As Integer = 50

        e.Graphics.DrawString("Liste des pointages ", font_titre, Brushes.Black, cl, ln)
        Dim ligne As New Pen(Color.Gray)
        ln = ln + 20
        e.Graphics.DrawLine(ligne, cl, ln, 750, ln)
        ln = ln + 20

        ' Dessiner les en-têtes de colonne
        With e.Graphics
            .DrawString("Num", font_tcolonne, Brushes.Black, cl, ln)
            ' Dessiner les autres en-têtes de colonne ici...
        End With
        ln = ln + 20
        e.Graphics.DrawLine(ligne, cl, ln, 750, ln)

        Dim c1, c2, c3, c4, c5, c6, c7, c8, c9 As String
        Dim nld As Integer 'nld : nombre_de_ligne_du_datagrid
        If etat = 1 Then nld = DataGridView1.Rows.Count
        If etat = 2 Then nld = DataGridView2.Rows.Count
        If etat = 3 Then nld = DataGridView2.Rows.Count

        For i = 0 To nld - 1
            If etat = 1 Then
                c1 = DataGridView1.Rows(i).Cells(0).Value.ToString()
                c2 = DataGridView1.Rows(i).Cells(1).Value.ToString()
                c3 = DataGridView1.Rows(i).Cells(2).Value.ToString()
                c4 = DataGridView1.Rows(i).Cells(3).Value.ToString()
                c5 = DataGridView1.Rows(i).Cells(4).Value.ToString()
                c6 = DataGridView1.Rows(i).Cells(5).Value.ToString()
                c7 = DataGridView1.Rows(i).Cells(6).Value.ToString()
                c8 = DataGridView1.Rows(i).Cells(7).Value.ToString()
                c9 = DataGridView1.Rows(i).Cells(8).Value.ToString()
            Else
                c1 = DataGridView2.Rows(i).Cells(0).Value.ToString()
                c2 = DataGridView2.Rows(i).Cells(1).Value.ToString()
                c3 = DataGridView2.Rows(i).Cells(2).Value.ToString()
                c4 = DataGridView2.Rows(i).Cells(3).Value.ToString()
                c5 = DataGridView2.Rows(i).Cells(4).Value.ToString()
                c6 = DataGridView2.Rows(i).Cells(5).Value.ToString()
                c7 = DataGridView2.Rows(i).Cells(6).Value.ToString()
                c8 = DataGridView2.Rows(i).Cells(7).Value.ToString()
                c9 = DataGridView2.Rows(i).Cells(8).Value.ToString()
            End If

            ' Dessiner une ligne de données
            With e.Graphics
                .DrawString(c1, font_colonne, Brushes.Black, cl, ln)
                .DrawString(c2, font_colonne, Brushes.Black, cl + 40, ln)
                .DrawString(c3, font_colonne, Brushes.Black, cl + 70, ln)
                .DrawString(c4, font_colonne, Brushes.Black, cl + 220, ln)
                .DrawString(c5, font_colonne, Brushes.Black, cl + 300, ln)
                .DrawString(c6, font_colonne, Brushes.Black, cl + 390, ln)
                .DrawString(c7, font_colonne, Brushes.Black, cl + 440, ln)
                .DrawString(c8, font_colonne, Brushes.Black, cl + 500, ln)
                .DrawString(c9, font_colonne, Brushes.Black, cl + 600, ln)
            End With
            ln = ln + 20
            e.Graphics.DrawLine(ligne, cl, ln, 750, ln)

        Next

        ' Dessiner le pied de page
        e.Graphics.DrawLine(ligne, cl, 1100, 750, 1100)
        e.Graphics.DrawString("Entreprise : Liste des pointages - Page {currentPage}", font_titre, Brushes.Black, cl, 1100)
    End Sub

    Private Sub ImprimerListeDesEmployésDunServiceToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles ImprimerListeDesEmployésDunServiceToolStripMenuItem.Click
        '-- Saisir les 2 dates
        Dim d1, d2 As String
        d1 = InputBox("Entrez la 1ère date : ", "Message d'impression", "")
        d2 = InputBox("Entrez la 2ème date : ", "Message d'impression", "")
        Dim dd1 As DateTime = Convert.ToDateTime(d1)
        Dim dd2 As DateTime = Convert.ToDateTime(d2)
        '-- Remplir le datagridview2
        connexion()
        requete = "select num, pointage.idemploye, nom, prenom, datepointage, left(right(heureentree,8), 5) as Arrivée, " & _
            "left(right(heuresortie, 8),5) as Départ, heuresortie, notes " & _
            "from pointage, employe " & _
            "where pointage.idemploye = employe.idemploye " & _
            " and datepointage between #" + dd1 + "# and #" + dd2 + "#;"

        InputBox("", "", requete)
        Dim da As New OleDbDataAdapter
        da = New OleDbDataAdapter(requete, con)
        Dim dt As New DataTable
        Dim ds As New DataSet
        da.Fill(dt)
        DataGridView2.DataSource = dt.DefaultView
        DataGridView2.Columns(0).Width = 100
        con.Close()
        'Imprimer l'état
        etat = 2
        DirectCast(PrintPreviewDialog1, Form).WindowState = FormWindowState.Maximized
        PrintDocument1.DefaultPageSettings.Landscape = False
        PrintPreviewDialog1.ShowDialog()
    End Sub

    Private Sub ImprimerHistoriqueDesAffectationsDunEmployéToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles ImprimerHistoriqueDesAffectationsDunEmployéToolStripMenuItem.Click
        'Saisir le id de l'employé
        Dim ide As String
        ide = InputBox("Entrez le ID de l'employé : ", "Message ")
        '-- Saisir les 2 dates
        Dim d1, d2 As String
        d1 = InputBox("Entrez la 1ère date de pointage : ", "Message d'impression", "")
        d2 = InputBox("Entrez la 2ème date de pointage : ", "Message d'impression", "")
        Dim dd1 As DateTime = Convert.ToDateTime(d1)
        Dim dd2 As DateTime = Convert.ToDateTime(d2)
        '-- Remplir le datagridview2
        connexion()
        requete = "select num, pointage.idemploye, nom, prenom, datepointage, left(right(heureentree,8), 5) as Arrivée, " & _
            "left(right(heuresortie, 8),5) as Départ, heuresortie, notes " & _
            "from pointage, employe " & _
            "where pointage.idemploye = employe.idemploye " & _
            " and datepointage between #" + dd1 + "# and #" + dd2 + "#" & _
            " and pointage.idemploye = " + ide

        Dim da As New OleDbDataAdapter
        da = New OleDbDataAdapter(requete, con)
        Dim dt As New DataTable
        Dim ds As New DataSet
        da.Fill(dt)
        DataGridView2.DataSource = dt.DefaultView
        DataGridView2.Columns(0).Width = 100
        con.Close()
        'Imprimer l'état
        etat = 2
        DirectCast(PrintPreviewDialog1, Form).WindowState = FormWindowState.Maximized
        PrintDocument1.DefaultPageSettings.Landscape = False
        PrintPreviewDialog1.ShowDialog()

    End Sub

    Private Sub ToolStripButton1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles ToolStripButton1.Click
        'Saisir une date de pointage
        Dim dp As String
        dp = InputBox("Entrez une date de pointage : ", "Message ", DateTime.Today.ToString("dd/MM/yyyy"))

        'Vérifier si la date de pointage existe déjà
        Dim r As String
        Dim trouve As Boolean = False
        For i = 0 To DataGridView1.Rows.Count
            r = DataGridView1.Rows(0).Cells(4).Value
            If (r = dp) Then
                trouve = True
                Exit For
            End If
        Next
        If (trouve) Then
            MsgBox("Date pointage est déjà saisi...", vbExclamation, "Message")
        Else
            '-----Enregistrer les pointages
            'Rechercher les ide
            connexion()
            requete = "select * from employe"
            cmdsql()
            Dim datae As IDataReader
            datae = cmd.ExecuteReader()
            Dim ide As String
            Dim requete_ins As String
            While datae.Read()
                ide = datae(0).ToString
                '-- insérer pou chaque ide son pointage
                requete_ins = "insert into  pointage " & _
                "(idemploye, datepointage, heureentree, heuresortie, typepointage)" & _
                " values (" + ide + ", #" + dp + "#, '09:00', '15:00','REGULIER')"

                cmd2.Connection = con
                cmd2.CommandText = requete_ins
                cmd2.ExecuteNonQuery()
            End While

            con.Close()
            MsgBox("Les pointages sont saisies automatiquemet...", MsgBoxStyle.OkOnly + MsgBoxStyle.Information, "Message")
            afficher_pointage()
        End If

    End Sub

    Private Sub ToolStripButton2_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles ToolStripButton2.Click
        Me.Close()
    End Sub

    Private Sub DataGridView1_CellContentClick(ByVal sender As System.Object, ByVal e As System.Windows.Forms.DataGridViewCellEventArgs) Handles DataGridView1.CellContentClick

    End Sub
End Class