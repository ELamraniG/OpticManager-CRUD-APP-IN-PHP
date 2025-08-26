Imports System.Data.OleDb
Imports System.IO
Imports System.Security.Cryptography
Imports System.Text

Public Class Employe_form

    Private Sub Employe_form_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Dim icone As New Icon("images/emp.ico")
        Me.Icon = icone
        Me.Text = "Formulaire Employé "
        Me.MinimizeBox = False
        Me.MaximizeBox = False
        Me.Width = 930
        Me.CenterToScreen()
        Idemploye.Focus()
    End Sub

    Private Sub Idemploye_GotFocus(ByVal sender As Object, ByVal e As System.EventArgs) Handles Idemploye.GotFocus, nomemploye.GotFocus, adresse.GotFocus, ncin.GotFocus, tel.GotFocus, fonction.GotFocus, specialite.GotFocus, prenom.GotFocus, email.GotFocus
        Dim textBox As TextBox = CType(sender, TextBox)
        textBox.BackColor = Color.Cyan
        textBox.Font = New Font(textBox.Font.FontFamily, 12, FontStyle.Bold)
    End Sub

    Private Sub Idemploye_LostFocus(ByVal sender As Object, ByVal e As System.EventArgs) Handles Idemploye.LostFocus, nomemploye.LostFocus, adresse.LostFocus, ncin.LostFocus, tel.LostFocus, fonction.LostFocus, specialite.LostFocus, prenom.LostFocus, email.LostFocus
        Dim textBox As TextBox = CType(sender, TextBox)
        textBox.BackColor = Color.White
        textBox.Font = New Font(textBox.Font.FontFamily, 10, FontStyle.Regular)
        If (textBox.Name = "nomemploye") Then
            If Not String.IsNullOrEmpty(nomemploye.Text) Then
                nomemploye.Text = UCase(nomemploye.Text)
                nomemploye.Font = New Font(nomemploye.Font.FontFamily, 10, FontStyle.Bold)
            End If
        End If
        If (textBox.Name = "prenom") Then
            If Not String.IsNullOrEmpty(prenom.Text) Then
                prenom.Text = prenom.Text.Substring(0, 1).ToUpper() + prenom.Text.Substring(1).ToLower()
                prenom.Font = New Font(prenom.Font.FontFamily, 10, FontStyle.Bold)
            End If
        End If

    End Sub


    Private Sub ouvrir_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Ouvrir.Click
        If (Idemploye.Text = Nothing Or nomemploye.Text = Nothing Or prenom.Text = Nothing) Then
            MsgBox("Veuillez saisir les données suivantes : ID, nom et prénom ! ", MsgBoxStyle.Information, "Message")
            Idemploye.Focus()
        Else
            'Je déclare une ofd pour ouvrir l'explorateur windows
            Dim ofd As New OpenFileDialog
            'Je fais un filtre pour ne chercher que les images 
            ofd.Filter = "Sélectionnez une image (*.jpg; *.png)|*.jpg; *.png"
            'Si l'user choisis une image
            If ofd.ShowDialog = DialogResult.OK Then
                'je met l'image dans le pricturebox
                PictureBox1.Image = Image.FromFile(ofd.FileName)
                'je copie le nom de l'image dans un label
                nom_photo.Text = ofd.FileName
                'je met dans une variable type_photo le type de la photo
                Dim type_photo As String = Mid(nom_photo.Text, Len(nom_photo.Text) - 3, 4)
                Dim nouveau_nom As String
                nouveau_nom = Idemploye.Text + nomemploye.Text + prenom.Text + type_photo
                anc_nom.Text = nom_photo.Text
                nom_photo.Text = "1_" + nouveau_nom
            End If
        End If
    End Sub

    Private Sub Save_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Save.Click
        If (Idemploye.Text = Nothing Or nomemploye.Text = Nothing Or prenom.Text = Nothing) Then
            MsgBox("Veuillez saisir les données suivantes : ID, nom et prénom ! ", MsgBoxStyle.Information, "Message")
            Idemploye.Focus()
        Else
            If type_operation.Text = "Ajouter" Then
                If (nom_photo.Text <> "employee.png") Then
                    File.Copy(anc_nom.Text, "images/" + nom_photo.Text)
                End If
                Dim mdp As String = ""
                requete = "insert into employe values (" + Idemploye.Text + ", '" + nom_photo.Text + "', '" + ncin.Text + "', '" + nomemploye.Text + "', '" + prenom.Text + "', '" + adresse.Text + "', '" + tel.Text + "', '" + email.Text + "', '" + ddn.Text + "', '" + ddr.Text + "', '" + fonction.Text + "', '" + specialite.Text + "', " + salairenet.Text + ", '" + mdp + "')"
            Else
                requete = "update employe set idemploye = " + Idemploye.Text + ", " & _
                        "ncin = '" + ncin.Text + "', " & _
                        "nom = '" + nomemploye.Text + "', " & _
                        "prenom = '" + prenom.Text + "', " & _
                        "adresse = '" + adresse.Text + "', " & _
                        "tel = '" + tel.Text + "', " & _
                        "email = '" + email.Text + "', " & _
                        "datedenaissance = '" + ddn.Text + "', " & _
                        "datederecrutement = '" + ddr.Text + "', " & _
                        "fonction = '" + fonction.Text + "', " & _
                        "specialite = '" + specialite.Text + "', " & _
                        "salairenet = " + salairenet.Text + ", " & _
                        "motdepasse = ''"
                If (nom_photo.Text <> "employee.png") Then
                    Try
                        File.Copy(anc_nom.Text, "images/" + nom_photo.Text)
                    Catch ex As Exception
                        Dim partie() As String = nom_photo.Text.Split("_")
                        Dim chiffre As Integer = Val(partie(0)) + 1
                        nom_photo.Text = chiffre.ToString + "_" + partie(1)
                        File.Copy(anc_nom.Text, "images/" + nom_photo.Text)
                    End Try
                    requete += ", photo = '" + nom_photo.Text + "'"
                End If
                requete += " where idemploye = " + ancien_idemploye.Text + ";"
            End If
            'Try
            connexion()
            cmdsql()
            cmd.ExecuteNonQuery()
            con.Close()
            Me.Close()
            requete = "select * from employe order by idemploye"
            employe.tout.Text = 1
            employe.afficher_employe(requete)
            'Catch ex As Exception
            '    MsgBox("Le ID employé existe déjà, Veuillez le remplacer par un autre", vbExclamation, "Message")
            '    con.Close()
            'End Try
        End If


    End Sub


End Class