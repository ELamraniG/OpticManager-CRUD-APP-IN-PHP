Imports System.Data.OleDb

Public Class Form18

    Private Sub Form18_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Dim icone As New Icon("images/emp.ico") 'il faut placer emp.ico dans le dossier debug
        Me.Icon = icone
        Me.Text = "Formulaire Membre"
        Me.MinimizeBox = False
        Me.MaximizeBox = False
        Me.CenterToScreen()

        Try
            ' Improved connection handling
            connexion()
            requete = "SELECT idcategoriemembre, nomcategoriemembre FROM categoriemembre ORDER BY idcategoriemembre"
            cmdsql()

            Dim data As IDataReader = Nothing
            Try
                idcategoriemembre.Items.Clear()
                data = cmd.ExecuteReader()

                While data.Read()
                    Dim categorieId As String = data(0).ToString()
                    Dim categorieName As String = data(1).ToString()
                    idcategoriemembre.Items.Add(categorieId + " | " + categorieName)
                End While
            Finally
                ' Always close the reader
                If data IsNot Nothing AndAlso Not data.IsClosed Then
                    data.Close()
                End If
                deconnexion()
            End Try

            ' Initialisation des valeurs pour un nouveau membre
            If type_operation.Text = "Ajouter" Then
                idmembre.Text = ""
                nom.Text = ""
                prenom.Text = ""
                adresse.Text = ""
                telephone.Text = ""
                email.Text = ""
                idcategoriemembre.Text = ""
                statut.SelectedIndex = 0  ' "actif" par défaut
                dateinscription.Value = Date.Now
            End If
        Catch ex As Exception
            MsgBox("Erreur: " & ex.Message, vbExclamation, "Erreur de base de données")
            deconnexion()
        End Try
    End Sub

    Private Sub Save_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Save.Click
        ' Validation basique
        If nom.Text = "" Then
            MsgBox("Veuillez saisir un nom!", vbExclamation, "Message")
            nom.Focus()
            Exit Sub
        End If

        If prenom.Text = "" Then
            MsgBox("Veuillez saisir un prénom!", vbExclamation, "Message")
            prenom.Focus()
            Exit Sub
        End If

        If telephone.Text = "" Then
            MsgBox("Veuillez saisir un numéro de téléphone!", vbExclamation, "Message")
            telephone.Focus()
            Exit Sub
        End If

        If idcategoriemembre.Text = "" Then
            MsgBox("Veuillez sélectionner une catégorie de membre!", vbExclamation, "Message")
            idcategoriemembre.Focus()
            Exit Sub
        End If

        ' Vérifier si l'email existe déjà
        If email.Text <> "" And (type_operation.Text = "Ajouter" Or (type_operation.Text = "Modifier" And ancien_email.Text <> email.Text)) Then
            Try
                connexion()
                requete = "SELECT COUNT(*) FROM membres WHERE email = '" & email.Text & "'"
                cmdsql()
                Dim count As Integer = cmd.ExecuteScalar()
                deconnexion()

                If count > 0 Then
                    MsgBox("Cette adresse email existe déjà!", vbExclamation, "Message")
                    email.Focus()
                    Exit Sub
                End If
            Catch ex As Exception
                MsgBox("Erreur: " & ex.Message, vbExclamation, "Erreur de base de données")
                deconnexion()
                Exit Sub
            End Try
        End If

        Try
            ' Extraire l'ID de la catégorie du ComboBox
            Dim categorieId As String = ""

            ' Extraire le categorieId du format "ID | Nom"
            If idcategoriemembre.Text.Contains("|") Then
                categorieId = idcategoriemembre.Text.Substring(0, idcategoriemembre.Text.IndexOf("|")).Trim()
            Else
                categorieId = idcategoriemembre.Text.Trim()
            End If

            ' Si vide, message d'erreur
            If String.IsNullOrEmpty(categorieId) Then
                MsgBox("Veuillez sélectionner une catégorie valide!", vbExclamation, "Message")
                idcategoriemembre.Focus()
                Exit Sub
            End If

            ' Format de date
            Dim dateStr As String = dateinscription.Value.ToString("yyyy/MM/dd")

            Try
                connexion()

                If type_operation.Text = "Ajouter" Then
                    requete = "INSERT INTO membres ([nom], [prenom], [adresse], [telephone], [email], " & _
                              "[idcategoriemembre], [statut], [dateinscription]) VALUES (?,?,?,?,?,?,?,?)"
                    cmdsql()
                    cmd.Parameters.Clear()

                    cmd.Parameters.Add("@p1", OleDbType.VarChar).Value = nom.Text
                    cmd.Parameters.Add("@p2", OleDbType.VarChar).Value = prenom.Text
                    cmd.Parameters.Add("@p3", OleDbType.VarChar).Value = adresse.Text
                    cmd.Parameters.Add("@p4", OleDbType.VarChar).Value = telephone.Text
                    cmd.Parameters.Add("@p5", OleDbType.VarChar).Value = email.Text
                    cmd.Parameters.Add("@p6", OleDbType.VarChar).Value = categorieId
                    cmd.Parameters.Add("@p7", OleDbType.VarChar).Value = statut.Text
                    cmd.Parameters.Add("@p8", OleDbType.Date).Value = dateinscription.Value
                Else ' Modifier
                    requete = "UPDATE membres SET [nom]=?, [prenom]=?, [adresse]=?, [telephone]=?, " & _
                              "[email]=?, [idcategoriemembre]=?, [statut]=?, [dateinscription]=? WHERE [idmembre]=?"
                    cmdsql()
                    cmd.Parameters.Clear()

                    cmd.Parameters.Add("@p1", OleDbType.VarChar).Value = nom.Text
                    cmd.Parameters.Add("@p2", OleDbType.VarChar).Value = prenom.Text
                    cmd.Parameters.Add("@p3", OleDbType.VarChar).Value = adresse.Text
                    cmd.Parameters.Add("@p4", OleDbType.VarChar).Value = telephone.Text
                    cmd.Parameters.Add("@p5", OleDbType.VarChar).Value = email.Text
                    cmd.Parameters.Add("@p6", OleDbType.VarChar).Value = categorieId
                    cmd.Parameters.Add("@p7", OleDbType.VarChar).Value = statut.Text
                    cmd.Parameters.Add("@p8", OleDbType.Date).Value = dateinscription.Value
                    cmd.Parameters.Add("@p9", OleDbType.Integer).Value = Convert.ToInt32(idmembre.Text)
                End If

                cmd.ExecuteNonQuery()
            Finally
                ' Always ensure we close the connection
                deconnexion()
            End Try

            Form17.afficher_membres()
            Me.Close()
        Catch ex As Exception
            MsgBox("Erreur: " & ex.Message, vbExclamation, "Erreur SQL")
            deconnexion() ' Redundant but safe
        End Try
    End Sub

    ' Sélectionner une catégorie par son ID
    Public Sub SelectCategorieById(ByVal categorieId As String)
        If String.IsNullOrEmpty(categorieId) Then
            Return
        End If

        ' Chercher l'item qui commence par l'ID de la catégorie
        For i As Integer = 0 To idcategoriemembre.Items.Count - 1
            Dim item As String = idcategoriemembre.Items(i).ToString()
            If item.StartsWith(categorieId & " |") Then
                idcategoriemembre.SelectedIndex = i
                Return
            End If
        Next

        ' Si non trouvé, afficher juste l'ID
        idcategoriemembre.Text = categorieId
    End Sub
End Class