Imports System.Data.OleDb
Public Class utilisateur

    Private Sub utilisateur_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Me.Width = 1200
        Me.Height = 600
        Me.CenterToScreen()
        Me.Text = "Gestion des utilisateurs"
        Dim icone As New Icon("images/emp.ico")
        Me.Icon = icone
        'style du datagridview
        DataGridView1.Width = Me.Width - 50
        DataGridView1.Height = Me.Height - 120
        DataGridView1.BorderStyle = BorderStyle.None
        DataGridView1.DefaultCellStyle.Font = New Font("Arial", 10)
        'Styles des colonnes
        DataGridView1.AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill
        DataGridView1.ColumnHeadersDefaultCellStyle.BackColor = Color.Cyan
        DataGridView1.EnableHeadersVisualStyles = False
        'Stles des lignes
        DataGridView1.AlternatingRowsDefaultCellStyle.BackColor = Color.LightCyan
        DataGridView1.CellBorderStyle = DataGridViewCellBorderStyle.None
        afficher_utilisateur()
    End Sub
    Public Sub afficher_utilisateur()
        connexion()
        requete = "select iduser as Num, employe.idemploye as idemploye, nom, prenom, utilisateur.* from utilisateur, employe " & _
            " where utilisateur.idemploye = employe.idemploye order by employe.idemploye"
        Dim da As New OleDbDataAdapter
        da = New OleDbDataAdapter(requete, con)
        Dim dt As New DataTable
        Dim ds As New DataSet
        da.Fill(dt)
        DataGridView1.DataSource = dt.DefaultView
        DataGridView1.Columns(0).Width = 100
        con.Close()
        'Chercher le nombre de ligne trouvées
        Dim nombre As Integer = DataGridView1.Rows.Count
        cpt.Text = "Nombre d'utilisateurs : " + nombre.ToString
        DataGridView1.AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.AllCells
    End Sub

    Private Sub ToolStripButton3_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles ToolStripButton3.Click
        Me.Close()
    End Sub

    Private Sub DataGridView1_CellDoubleClick(ByVal sender As Object, ByVal e As System.Windows.Forms.DataGridViewCellEventArgs) Handles DataGridView1.CellDoubleClick
        Dim i As Integer
        i = DataGridView1.CurrentCell.RowIndex
        'Remplir le combo employé par le id, le nom et prénom
        Dim txt As String = DataGridView1.Rows(i).Cells(1).Value.ToString + " | " + DataGridView1.Rows(i).Cells(2).Value + " " + DataGridView1.Rows(i).Cells(3).Value
        utilisateur_form.idemploye.Text = txt

        utilisateur_form.loginutilisateur.Text = If(Not IsDBNull(DataGridView1.Rows(i).Cells(6).Value), DataGridView1.Rows(i).Cells(6).Value.ToString(), "")
        utilisateur_form.motdepasseutilisateur.Text = If(Not IsDBNull(DataGridView1.Rows(i).Cells(7).Value), DataGridView1.Rows(i).Cells(7).Value.ToString(), "")
        utilisateur_form.typeutilisateur.Text = If(Not IsDBNull(DataGridView1.Rows(i).Cells(8).Value), DataGridView1.Rows(i).Cells(8).Value.ToString(), "")

        'Pour aider la requête de update à s'exécuter
        utilisateur_form.ancien_iduser.Text = DataGridView1.Rows(i).Cells(0).Value.ToString
        utilisateur_form.type_operation.Text = "Modifier"
        utilisateur_form.ShowDialog()
        afficher_utilisateur()
    End Sub
    Private Sub DataGridView1_CellFormatting(ByVal sender As Object, ByVal e As DataGridViewCellFormattingEventArgs) Handles DataGridView1.CellFormatting
        If e.Value IsNot Nothing AndAlso (e.Value.ToString() = "1" Or e.Value.ToString() = "0") Then
            If e.Value.ToString() = "1" Then
                e.Value = Char.ConvertFromUtf32(&H2713) ' Remplace "1" par le symbole de coche  
                e.CellStyle.Alignment = DataGridViewContentAlignment.MiddleCenter ' Centre le contenu de la cellule
                e.CellStyle.Font = New Font("Arial", 16) ' Définit une police plus grande
                e.CellStyle.BackColor = Color.LightBlue ' Définit la couleur de fond en cyan
            Else
                e.Value = ""
            End If
            e.FormattingApplied = True
        End If
    End Sub

    Private Sub ToolStripButton1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles ToolStripButton1.Click
        utilisateur_form.loginutilisateur.Text = Nothing
        utilisateur_form.motdepasseutilisateur.Text = Nothing
        utilisateur_form.typeutilisateur.Text = "Admin"
        utilisateur_form.decochezTout_Click(sender, e)
        utilisateur_form.type_operation.Text = "Ajouter"
        utilisateur_form.idemploye.SelectedIndex = -1
        utilisateur_form.ShowDialog()
    End Sub

    Private Sub Actualiser_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Actualiser.Click
        afficher_utilisateur()
    End Sub

    Private Sub Supprimer_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Supprimer.Click
        If (DataGridView1.Rows.Count = 0) Then
            MsgBox("Aucun utilisateur...", vbExclamation, "Message")
        Else
            Dim i As Integer = DataGridView1.CurrentCell.RowIndex
            Dim id As String = DataGridView1.Rows(i).Cells(0).Value
            Dim rep As MsgBoxResult
            rep = MsgBox("Etes-vous sûr de supprimer l'utilisateur : " + id + "? ", vbYesNo + vbQuestion, "Confirmation")
            If (rep = vbYes) Then
                connexion()
                requete = "delete from utilisateur where iduser = " + id
                cmdsql()
                cmd.ExecuteNonQuery()
                con.Close()
                afficher_utilisateur()
            End If
        End If
    End Sub

    Private Sub DataGridView1_CellContentClick(ByVal sender As System.Object, ByVal e As System.Windows.Forms.DataGridViewCellEventArgs) Handles DataGridView1.CellContentClick

    End Sub
End Class