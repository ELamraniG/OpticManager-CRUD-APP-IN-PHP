Public Class utilisateur_form

    Private Sub utilisateur_form_FormClosed(ByVal sender As Object, ByVal e As System.Windows.Forms.FormClosedEventArgs) Handles Me.FormClosed
        Me.loginutilisateur.Text = Nothing
        Me.motdepasseutilisateur.Text = Nothing
        Me.typeutilisateur.Text = "Admin"
        Me.decochezTout_Click(sender, e)
        Me.type_operation.Text = "Ajouter"
        Me.idemploye.SelectedIndex = -1
    End Sub

    Private Sub utilisateur_form_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Dim icone As New Icon("images/emp.ico")
        Me.Icon = icone
        Me.Text = "Formulaire de saisie d'un utilisateur "
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
        If (type_operation.Text = "Ajouter") Then
            idemploye.Text = Nothing
        End If
        'Recherche des options autorisées en cas de la modification
        Dim c1 As String = Nothing
        Dim c2 As String = Nothing
        Dim c3 As String = Nothing
        Dim c4 As String = Nothing
        Dim c5 As String = Nothing
        Dim c6 As String = Nothing
        Dim c7 As String = Nothing
        Dim c8 As String = Nothing
        Dim c9 As String = Nothing
        Dim c10 As String = Nothing
        Dim c11 As String = Nothing
        Dim c12 As String = Nothing
        Dim c13 As String = Nothing
        Dim c14 As String = Nothing
        Dim c15 As String = Nothing
        Dim c16 As String = Nothing
        Dim c17 As String = Nothing


        If (type_operation.Text = "Modifier") Then
            connexion()
            requete = "select * from utilisateur where iduser = " + ancien_iduser.Text
            cmdsql()
            Dim datau As IDataReader
            datau = cmd.ExecuteReader()
            While datau.Read()
                c1 = datau(5).ToString()
                c2 = datau(6).ToString()
                c3 = datau(7).ToString()
                c4 = datau(8).ToString()
                c5 = datau(9).ToString()
                c6 = datau(10).ToString()
                c7 = datau(11).ToString()
                c8 = datau(12).ToString()
                c9 = datau(13).ToString()
                c10 = datau(14).ToString()
                c11 = datau(15).ToString()
                c12 = datau(16).ToString()
                c13 = datau(18).ToString()
                c14 = datau(19).ToString()
                c15 = datau(20).ToString()
                c16 = datau(21).ToString()
            End While
            con.Close()
        End If
        ' Position initiale des cases à cocher
        Dim xPosition As Integer = 10 ' Position X de départ
        Dim yPosition As Integer = 20 ' Position Y de départ

        ' Nombre de cases à cocher par colonne
        Dim casesParColonne As Integer = 6

        ' Index pour suivre le nombre de cases ajoutées à chaque colonne
        Dim casesAjoutees As Integer = 0

        ' Créer une case à cocher pour chaque colonne
        Dim colonnes() As String = {"organisation", "gestiondesservices", "gestiondesemployes", "affectationdesemployes", "pointage", "pointageindividuel", "pointageautomatique", "rapport", "rapportdepointage", "lespointagesdunemploye", "lespointagesdunservice", "rapportdaffectation", "lesemployesdunservice", "lesaffectationdunemploye", "parametre", "gestiondesutilisateurs", "configurationdelapplication"}
        For Each colonne As String In colonnes
            ' Créer une case à cocher
            Dim checkbox As New CheckBox()
            checkbox.Text = colonne.ToUpper()
            checkbox.Name = "chk" & colonne
            checkbox.AutoSize = True
            checkbox.Location = New Point(xPosition, yPosition)
            checkbox.Size = New Size(32, 32)
            checkbox.Font = New Font("Arial", 12)

            If (c1 = "1" And colonne = "organisation") Then checkbox.Checked = True
            If (c2 = "1" And colonne = "gestiondesservices") Then checkbox.Checked = True
            If (c3 = "1" And colonne = "gestiondesemployes") Then checkbox.Checked = True
            If (c4 = "1" And colonne = "affectationdesemployes") Then checkbox.Checked = True
            If (c5 = "1" And colonne = "pointage") Then checkbox.Checked = True
            If (c6 = "1" And colonne = "pointageindividuel") Then checkbox.Checked = True
            If (c7 = "1" And colonne = "pointageautomatique") Then checkbox.Checked = True
            If (c8 = "1" And colonne = "rapport") Then checkbox.Checked = True
            If (c9 = "1" And colonne = "rapportdepointage") Then checkbox.Checked = True
            If (c10 = "1" And colonne = "lespointagesdunemploye") Then checkbox.Checked = True
            If (c11 = "1" And colonne = "lespointagesdunservice") Then checkbox.Checked = True
            If (c12 = "1" And colonne = "rapportdaffectation") Then checkbox.Checked = True
            If (c13 = "1" And colonne = "lesemployesdunservice") Then checkbox.Checked = True
            If (c14 = "1" And colonne = "lesaffectationdunemploye") Then checkbox.Checked = True
            If (c15 = "1" And colonne = "parametre") Then checkbox.Checked = True
            If (c16 = "1" And colonne = "gestiondesutilisateurs") Then checkbox.Checked = True
            If (c17 = "1" And colonne = "configurationdelapplication") Then checkbox.Checked = True
            GroupBox2.Controls.Add(checkbox)

            yPosition += 35 ' Augmenter la position Y pour la prochaine case à cocher 

            ' Incrémenter le nombre de cases ajoutées à cette colonne
            casesAjoutees += 1

            ' Vérifier si le nombre de cases ajoutées atteint la limite par colonne
            If casesAjoutees = casesParColonne Then
                ' Réinitialiser la position Y et incrémenter la position X pour passer à la colonne suivante
                yPosition = 20 ' Position Y de départ
                xPosition += 280 ' Augmenter la position X pour passer à la colonne suivante
                casesAjoutees = 0 ' Réinitialiser le nombre de cases ajoutées à cette colonne
            End If
        Next

    End Sub

    Private Sub toutCochez_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles toutCochez.Click
        ' Parcourir tous les contrôles dans le formulaire
        For Each control As Control In GroupBox2.Controls
            ' Vérifier si le contrôle est une case à cocher
            If TypeOf control Is CheckBox Then
                ' Cocher la case à cocher
                DirectCast(control, CheckBox).Checked = True
            End If
        Next
    End Sub

    Public Sub decochezTout_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles decochezTout.Click
        ' Parcourir tous les contrôles dans le formulaire
        For Each control As Control In GroupBox2.Controls
            ' Vérifier si le contrôle est une case à cocher
            If TypeOf control Is CheckBox Then
                ' Cocher la case à cocher
                DirectCast(control, CheckBox).Checked = False
            End If
        Next
    End Sub

    Private Sub enregistrer_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles enregistrer.Click
        connexion()
        Dim p As Integer
        Dim ide As String = "0"
        If (idemploye.SelectedIndex <> -1) Then
            p = InStr(idemploye.Text, "|")
            ide = Mid(idemploye.Text, 1, p - 1)
        End If
        Dim c1 As String = GetCheckBoxValue("chkorganisation")
        Dim c2 As String = GetCheckBoxValue("chkgestiondesservices")
        Dim c3 As String = GetCheckBoxValue("chkgestiondesemployes")
        Dim c4 As String = GetCheckBoxValue("chkaffectationdesemployes")
        Dim c5 As String = GetCheckBoxValue("chkpointage")
        Dim c6 As String = GetCheckBoxValue("chkpointageindividuel")
        Dim c7 As String = GetCheckBoxValue("chkpointageautomatique")
        Dim c8 As String = GetCheckBoxValue("chkrapport")
        Dim c9 As String = GetCheckBoxValue("chkrapportdepointage")
        Dim c10 As String = GetCheckBoxValue("chklespointagesdunemploye")
        Dim c11 As String = GetCheckBoxValue("chklespointagesdunservice")
        Dim c12 As String = GetCheckBoxValue("chkrapportdaffectation")
        Dim c13 As String = GetCheckBoxValue("chklesemployesdunservice")
        Dim c14 As String = GetCheckBoxValue("chklesaffectationdunemploye")
        Dim c15 As String = GetCheckBoxValue("chkparametre")
        Dim c16 As String = GetCheckBoxValue("chkgestiondesutilisateurs")
        Dim c17 As String = GetCheckBoxValue("chkconfigurationdelapplication")

        Dim requete As String = "insert into utilisateur(idemploye, login, motdepasseutilisateur, organisation, gestiondesservices, gestiondesemployes, affectationdesemployes, pointage, pointageindividuel, pointageautomatique, rapport, rapportdepointage, lespointagesdunemploye, lespointagesdunservice, rapportdaffectation, lesemployesdunservice, lesaffectationdunemploye, parametre, gestiondesutilisateurs, configurationdelapplication) " & _
            "values (" + ide + ", '" + loginutilisateur.Text + "', '" + motdepasseutilisateur.Text + "', " + c1 + ", " + c2 + ", " + c3 + ", " + c4 + "," + c5 + ", " + c6 + ", " + c7 + ", " + c8 + ", " + c9 + ", " + c10 + ", " + c11 + ", " + c12 + ", " + c13 + "," + c14 + ", " + c15 + ", " + c16 + ", " + c17 + ")"
        cmd.CommandText = requete
        cmd.ExecuteNonQuery()
        con.Close()
        Me.Close()
        utilisateur.afficher_utilisateur()
    End Sub

    Function GetCheckBoxValue(ByVal name As String) As Integer
        Dim checkBox As CheckBox = GroupBox2.Controls.OfType(Of CheckBox)().FirstOrDefault(Function(cb) cb.Name = name)
        If checkBox IsNot Nothing AndAlso checkBox.Checked Then
            Return 1
        Else
            Return 0
        End If
    End Function

End Class