Imports System.Data.OleDb

Public Class affecter
    Public etat As Integer

    Private Sub affecter_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Dim icone As New Icon("images/emp.ico")
        Me.Icon = icone
        Me.Text = "Gestion des affectations "
        Me.BackColor = Color.White
        Me.Width = 1200
        Me.Height = 600
        Me.CenterToScreen()
        DataGridView1.Width = Me.Width - 40
        DataGridView1.Height = Me.Height - 220
        DataGridView1.BorderStyle = BorderStyle.None
        DataGridView1.DefaultCellStyle.Font = New Font("Arial", 10)
        DataGridView1.AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill
        DataGridView1.ColumnHeadersDefaultCellStyle.BackColor = Color.Cyan
        DataGridView1.EnableHeadersVisualStyles = False
        DataGridView1.AlternatingRowsDefaultCellStyle.BackColor = Color.LightCyan
        DataGridView1.CellBorderStyle = DataGridViewCellBorderStyle.None

        afficher_affecter()

    End Sub

    Public Sub afficher_affecter()
        connexion()
        'Requete à modifier : Jointure 
        requete = "select affecter.idservice, nomservice, affecter.idemploye, nom, prenom, datedebut, datefin " & _
            "from affecter, employe, service " & _
            "where affecter.idemploye = employe.idemploye " & _
            "and affecter.idservice = service.idservice"

        Dim da As New OleDbDataAdapter
        da = New OleDbDataAdapter(requete, con)
        Dim dt As New DataTable
        Dim ds As New DataSet
        da.Fill(dt)
        DataGridView1.DataSource = dt.DefaultView
        DataGridView1.Columns(0).Width = 100
        con.Close()
        Dim nombre As Integer = DataGridView1.Rows.Count
        cpt.Text = "Nombre de services : " + nombre.ToString
        If (affecter_form.type_operation.Text = "Ajouter") Then
            DataGridView1.FirstDisplayedScrollingRowIndex = DataGridView1.Rows.Count - 1
            DataGridView1.Rows(DataGridView1.Rows.Count - 1).Selected = True
        End If
        If (affecter_form.type_operation.Text = "Modifier") Then
            DataGridView1.Rows(Val(affecter_form.ligne_modifie.Text)).Selected = True
        End If
    End Sub

    Private Sub Ajouter_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Ajouter.Click
        affecter_form.type_operation.Text = "Ajouter"
        affecter_form.ShowDialog()
        afficher_affecter()
    End Sub

    Private Sub DataGridView1_CellDoubleClick(ByVal sender As Object, ByVal e As System.Windows.Forms.DataGridViewCellEventArgs) Handles DataGridView1.CellDoubleClick
        Dim i As Integer
        i = DataGridView1.CurrentCell.RowIndex
        Dim txt As String = DataGridView1.Rows(i).Cells(0).Value + " | " + DataGridView1.Rows(i).Cells(1).Value
        affecter_form.idservice.Text = txt
        txt = DataGridView1.Rows(i).Cells(2).Value.ToString + " | " + DataGridView1.Rows(i).Cells(3).Value + " " + DataGridView1.Rows(i).Cells(4).Value
        affecter_form.idemploye.Text = txt
        affecter_form.datedebut.Text = DataGridView1.Rows(i).Cells(5).Value
        
        affecter_form.datefin.Text = DataGridView1.Rows(i).Cells(6).Value.ToString
        affecter_form.ancien_idservice.Text = DataGridView1.Rows(i).Cells(0).Value
        affecter_form.ancien_ide.Text = DataGridView1.Rows(i).Cells(2).Value

        affecter_form.datefin_vide.Text = DataGridView1.Rows(i).Cells(6).Value.ToString
        affecter_form.ligne_modifie.Text = i
        affecter_form.type_operation.Text = "Modifier"
        affecter_form.ShowDialog()
        afficher_affecter()
    End Sub

    Private Sub Supprimer_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Supprimer.Click
        affecter_form.type_operation.Text = "Ajouter"
        If (DataGridView1.Rows.Count = 0) Then
            MsgBox("Aucune affectation...", vbExclamation, "Message")
        Else
            Dim i As Integer = DataGridView1.CurrentCell.RowIndex
            Dim ids As String = DataGridView1.Rows(i).Cells(0).Value
            Dim ide As String = DataGridView1.Rows(i).Cells(2).Value
            Dim rep As MsgBoxResult
            rep = MsgBox("Etes-vous sûr de supprimer cette affectation ? ", vbYesNo + vbQuestion, "Confirmation")
            If (rep = vbYes) Then
                connexion()
                requete = "delete from affecter where idservice = '" + ids + "' and idemploye = " & ide
                cmdsql()
                cmd.ExecuteNonQuery()
                con.Close()
                afficher_affecter()
            End If
        End If
    End Sub

    Private Sub Rechercher_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Rechercher.Click
        Dim nom_a_chercher As String
        nom_a_chercher = InputBox("Entrez le nom ou le prénom ou le nom du service à chercher : ", "Recherche", "")
        connexion()

        requete = "select distinct affecter.idservice, nomservice, affecter.idemploye, nom, prenom, datedebut, datefin " & _
            "from affecter, employe, service " & _
            "where affecter.idservice = service.idservice " & _
            "and affecter.idemploye = employe.idemploye " & _
            "and nom+prenom+nomservice LIKE '%" + nom_a_chercher + "%'"
        Dim da As New OleDbDataAdapter
        da = New OleDbDataAdapter(requete, con)
        Dim dt As New DataTable
        Dim ds As New DataSet
        da.Fill(dt)
        DataGridView1.DataSource = dt.DefaultView
        DataGridView1.Columns(0).Width = 100
        con.Close()
        If (DataGridView1.Rows.Count = 0) Then MsgBox("Introuvable...", vbExclamation, "Message")
    End Sub

    Private Sub Actualiser_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Actualiser.Click
        afficher_affecter()
    End Sub

    Private Sub ImprimerTousLesServicesToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles ImprimerTousLesServicesToolStripMenuItem.Click
        etat = 1
        DirectCast(PrintPreviewDialog1, Form).WindowState = FormWindowState.Maximized
        PrintDocument1.DefaultPageSettings.Landscape = False
        PrintPreviewDialog1.ShowDialog()


    End Sub

    Private Sub PrintDocument1_PrintPage(ByVal sender As System.Object, ByVal e As System.Drawing.Printing.PrintPageEventArgs) Handles PrintDocument1.PrintPage
        Dim font_titre As New Font("Arial", 12, FontStyle.Regular)
        Dim font_tcolonne As New Font("Arial", 10, FontStyle.Bold)
        Dim font_colonne As New Font("Arial", 10, FontStyle.Regular)
        Dim ln As Integer = 50
        Dim cl As Integer = 50
        e.Graphics.DrawString("Liste des affectations ", font_titre, Brushes.Black, cl, ln)
        Dim ligne As New Pen(Color.Gray)
        ln = ln + 20
        e.Graphics.DrawLine(ligne, cl, ln, 750, ln)
        ln = ln + 20
        With e.Graphics
            .DrawString("Id Service", font_tcolonne, Brushes.Black, cl, ln)
            .DrawString("Service", font_tcolonne, Brushes.Black, cl + 80, ln)
            .DrawString("Id ", font_tcolonne, Brushes.Black, cl + 280, ln)
            .DrawString("Nom", font_tcolonne, Brushes.Black, cl + 300, ln)
            .DrawString("Prénom", font_tcolonne, Brushes.Black, cl + 400, ln)
            .DrawString("Date début", font_tcolonne, Brushes.Black, cl + 520, ln)
            .DrawString("Date Fin", font_tcolonne, Brushes.Black, cl + 620, ln)
        End With
        ln = ln + 20
        e.Graphics.DrawLine(ligne, cl, ln, 750, ln)
        Dim c1, c2, c3, c4, c5, c6, c7 As String
        Dim nld As Integer 'nld : nombre_de_ligne_du_datagrid
        If etat = 1 Then nld = DataGridView1.Rows.Count
        If etat = 2 Then nld = DataGridView2.Rows.Count
        If etat = 3 Then nld = DataGridView2.Rows.Count
        For i = 0 To nld - 1
            If etat = 1 Then
                c1 = DataGridView1.Rows(i).Cells(0).Value
                c2 = DataGridView1.Rows(i).Cells(1).Value
                c3 = DataGridView1.Rows(i).Cells(2).Value
                c4 = DataGridView1.Rows(i).Cells(3).Value
                c5 = DataGridView1.Rows(i).Cells(4).Value
                c6 = DataGridView1.Rows(i).Cells(5).Value
                c7 = DataGridView1.Rows(i).Cells(6).Value
            Else
                c1 = DataGridView2.Rows(i).Cells(0).Value
                c2 = DataGridView2.Rows(i).Cells(1).Value
                c3 = DataGridView2.Rows(i).Cells(2).Value
                c4 = DataGridView2.Rows(i).Cells(3).Value
                c5 = DataGridView2.Rows(i).Cells(4).Value
                c6 = DataGridView2.Rows(i).Cells(5).Value
                c7 = DataGridView2.Rows(i).Cells(6).Value
            End If
            
            With e.Graphics
                .DrawString(c1, font_colonne, Brushes.Black, cl, ln)
                .DrawString(c2, font_colonne, Brushes.Black, cl + 80, ln)
                .DrawString(c3, font_colonne, Brushes.Black, cl + 280, ln)
                .DrawString(c4, font_colonne, Brushes.Black, cl + 300, ln)
                .DrawString(c5, font_colonne, Brushes.Black, cl + 400, ln)
                .DrawString(c6, font_colonne, Brushes.Black, cl + 520, ln)
                .DrawString(c7, font_colonne, Brushes.Black, cl + 620, ln)
            End With
            ln = ln + 20
            e.Graphics.DrawLine(ligne, cl, ln, 750, ln)
        Next
        e.Graphics.DrawLine(ligne, cl, 1100, 750, 1100)
        e.Graphics.DrawString("Entreprise : Liste des affectations ", font_titre, Brushes.Black, cl, 1100)
    End Sub

    Public Sub ImprimerListeDesEmployésDunServiceToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles ImprimerListeDesEmployésDunServiceToolStripMenuItem.Click
        etat = 2
        Dim nom_service As String
        nom_service = InputBox("Entrez le nom du service à chercher", "Imprimer liste des employés d'un service", "Service ")

        'liste des employés d'un service
        connexion()
        requete = "select affecter.idservice, nomservice, affecter.idemploye, nom, prenom, datedebut, datefin " & _
            "from affecter, employe, service " & _
            "where affecter.idemploye = employe.idemploye " & _
            "and affecter.idservice = service.idservice " & _
            "and nomservice like '" + nom_service + "'"

        Dim da As New OleDbDataAdapter
        da = New OleDbDataAdapter(requete, con)
        Dim dt As New DataTable
        Dim ds As New DataSet
        da.Fill(dt)
        DataGridView2.DataSource = dt.DefaultView
        DataGridView2.Columns(0).Width = 100
        con.Close()

        Dim cpt As Integer = DataGridView2.Rows.Count()

        If cpt = 0 Then
            MsgBox("Service entré introuvable...", MsgBoxStyle.Information, "Message")
        Else
            'Imprimer
            DirectCast(PrintPreviewDialog1, Form).WindowState = FormWindowState.Maximized
            PrintDocument1.DefaultPageSettings.Landscape = False
            PrintPreviewDialog1.ShowDialog()
        End If

    End Sub

    Public Sub ImprimerHistoriqueDesAffectationsDunEmployéToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles ImprimerHistoriqueDesAffectationsDunEmployéToolStripMenuItem.Click
        etat = 3
        Dim nom_employe As String
        nom_employe = InputBox("Entrez le nom et/ou le prénom de l'employé à chercher", "Imprimer historique des affectations d'un employé", "")

        'historique des affectations d'employé
        connexion()
        requete = "select affecter.idservice, nomservice, affecter.idemploye, nom, prenom, datedebut, datefin " & _
            "from affecter, employe, service " & _
            "where affecter.idemploye = employe.idemploye " & _
            "and affecter.idservice = service.idservice " & _
            "and nom+prenom like '%" + nom_employe + "%'"

        Dim da As New OleDbDataAdapter
        da = New OleDbDataAdapter(requete, con)
        Dim dt As New DataTable
        Dim ds As New DataSet
        da.Fill(dt)
        DataGridView2.DataSource = dt.DefaultView
        DataGridView2.Columns(0).Width = 100
        con.Close()

        Dim cpt As Integer = DataGridView2.Rows.Count()

        If cpt = 0 Then
            MsgBox("Employé entré introuvable...", MsgBoxStyle.Information, "Message")
        Else
            'Imprimer
            DirectCast(PrintPreviewDialog1, Form).WindowState = FormWindowState.Maximized
            PrintDocument1.DefaultPageSettings.Landscape = False
            PrintPreviewDialog1.ShowDialog()
        End If
    End Sub

    Private Sub DataGridView1_CellContentClick(ByVal sender As System.Object, ByVal e As System.Windows.Forms.DataGridViewCellEventArgs) Handles DataGridView1.CellContentClick

    End Sub

    Private Sub ToolStripButton1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles ToolStripButton1.Click
        Me.Close()
    End Sub
End Class