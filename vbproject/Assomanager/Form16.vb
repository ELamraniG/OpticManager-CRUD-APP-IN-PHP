Imports System.Data.OleDb

Public Class Form16

    Private Sub Form16_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Dim icone As New Icon("images/emp.ico") 'il faut placer emp.ico dans le dossier debug
        Me.Icon = icone
        Me.Text = "Formulaire Utilisateur"
        Me.MinimizeBox = False
        Me.MaximizeBox = False
        Me.CenterToScreen()
        
        Try
            ' Improved connection handling
            connexion()
            requete = "SELECT idrole, nomrole FROM roles ORDER BY idrole"
            cmdsql()
            
            Dim data As IDataReader = Nothing
            Try
                idrole.Items.Clear()
                data = cmd.ExecuteReader()
                
                While data.Read()
                    Dim roleId As String = data(0).ToString()
                    Dim roleName As String = data(1).ToString()
                    idrole.Items.Add(roleId + " | " + roleName)
                End While
            Finally
                ' Always close the reader
                If data IsNot Nothing AndAlso Not data.IsClosed Then
                    data.Close()
                End If
                deconnexion()
            End Try
            
            ' Initialisation des valeurs pour un nouvel utilisateur
            If type_operation.Text = "Ajouter" Then
                idutilisateur.Text = ""
                nom.Text = ""
                email.Text = ""
                motdepasse.Text = ""
                idrole.Text = ""
                statut.SelectedIndex = 0  ' "actif" par défaut
                datecreation.Value = Date.Now
            End If
        Catch ex As Exception
            MsgBox("Erreur: " & ex.Message, vbExclamation, "Erreur de base de données")
            deconnexion()
        End Try
    End Sub

    Private Sub Save_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Save.Click
        ' Validation basique
        If nom.Text = "" Then
            MsgBox("Veuillez saisir un nom d'utilisateur!", vbExclamation, "Message")
            nom.Focus()
            Exit Sub
        End If
        
        If email.Text = "" Then
            MsgBox("Veuillez saisir une adresse email!", vbExclamation, "Message")
            email.Focus()
            Exit Sub
        End If
        
        If motdepasse.Text = "" And type_operation.Text = "Ajouter" Then
            MsgBox("Veuillez saisir un mot de passe!", vbExclamation, "Message")
            motdepasse.Focus()
            Exit Sub
        End If
        
        If idrole.Text = "" Then
            MsgBox("Veuillez sélectionner un rôle!", vbExclamation, "Message")
            idrole.Focus()
            Exit Sub
        End If
        
        ' Vérifier si l'email existe déjà
        If type_operation.Text = "Ajouter" Or (type_operation.Text = "Modifier" And ancien_email.Text <> email.Text) Then
            Try
                connexion()
                requete = "SELECT COUNT(*) FROM utilisateurs WHERE email = '" & email.Text & "'"
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
            ' Extraire l'ID du rôle du ComboBox (en tant que STRING)
            Dim roleId As String = ""
            
            ' Extraire le roleId du format "ID | Nom"
            If idrole.Text.Contains("|") Then
                roleId = idrole.Text.Substring(0, idrole.Text.IndexOf("|")).Trim()
            Else
                roleId = idrole.Text.Trim()
            End If
            
            ' Si vide, message d'erreur
            If String.IsNullOrEmpty(roleId) Then
                MsgBox("Veuillez sélectionner un rôle valide!", vbExclamation, "Message")
                idrole.Focus()
                Exit Sub
            End If
            
            ' Format de date
            Dim dateStr As String = datecreation.Value.ToString("yyyy/MM/dd")
            
            Try
                connexion()
                
                If type_operation.Text = "Ajouter" Then
                    requete = "INSERT INTO utilisateurs ([nom], [email], [motdepasse], [idrole], [statut], [datecreation]) VALUES (?,?,?,?,?,?)"
                    cmdsql()
                    cmd.Parameters.Clear()
                    
                    ' Traiter le roleId comme une chaîne (VarChar)
                    cmd.Parameters.Add("@p1", OleDbType.VarChar).Value = nom.Text
                    cmd.Parameters.Add("@p2", OleDbType.VarChar).Value = email.Text
                    cmd.Parameters.Add("@p3", OleDbType.VarChar).Value = motdepasse.Text
                    cmd.Parameters.Add("@p4", OleDbType.VarChar).Value = roleId
                    cmd.Parameters.Add("@p5", OleDbType.VarChar).Value = statut.Text
                    cmd.Parameters.Add("@p6", OleDbType.Date).Value = datecreation.Value
                Else ' Modifier
                    If motdepasse.Text <> "" Then
                        requete = "UPDATE utilisateurs SET [nom]=?, [email]=?, [motdepasse]=?, [idrole]=?, [statut]=?, [datecreation]=? WHERE [idutilisateur]=?"
                        cmdsql()
                        cmd.Parameters.Clear()
                        
                        cmd.Parameters.Add("@p1", OleDbType.VarChar).Value = nom.Text
                        cmd.Parameters.Add("@p2", OleDbType.VarChar).Value = email.Text
                        cmd.Parameters.Add("@p3", OleDbType.VarChar).Value = motdepasse.Text
                        cmd.Parameters.Add("@p4", OleDbType.VarChar).Value = roleId
                        cmd.Parameters.Add("@p5", OleDbType.VarChar).Value = statut.Text
                        cmd.Parameters.Add("@p6", OleDbType.Date).Value = datecreation.Value
                        cmd.Parameters.Add("@p7", OleDbType.Integer).Value = Convert.ToInt32(idutilisateur.Text)
                    Else
                        requete = "UPDATE utilisateurs SET [nom]=?, [email]=?, [idrole]=?, [statut]=?, [datecreation]=? WHERE [idutilisateur]=?"
                        cmdsql()
                        cmd.Parameters.Clear()
                        
                        cmd.Parameters.Add("@p1", OleDbType.VarChar).Value = nom.Text
                        cmd.Parameters.Add("@p2", OleDbType.VarChar).Value = email.Text
                        cmd.Parameters.Add("@p3", OleDbType.VarChar).Value = roleId
                        cmd.Parameters.Add("@p4", OleDbType.VarChar).Value = statut.Text
                        cmd.Parameters.Add("@p5", OleDbType.Date).Value = datecreation.Value
                        cmd.Parameters.Add("@p6", OleDbType.Integer).Value = Convert.ToInt32(idutilisateur.Text)
                    End If
                End If
                
                cmd.ExecuteNonQuery()
            Finally
                ' Always ensure we close the connection
                deconnexion()
            End Try
            
            Form15.afficher_utilisateurs()
            Me.Close()
        Catch ex As Exception
            MsgBox("Erreur: " & ex.Message, vbExclamation, "Erreur SQL")
            deconnexion() ' Redundant but safe
        End Try
    End Sub
    
    ' Sélectionner un rôle par son ID
    Public Sub SelectRoleById(ByVal roleId As String)
        If String.IsNullOrEmpty(roleId) Then
            Return
        End If
        
        ' Chercher l'item qui commence par l'ID du rôle
        For i As Integer = 0 To idrole.Items.Count - 1
            Dim item As String = idrole.Items(i).ToString()
            If item.StartsWith(roleId & " |") Then
                idrole.SelectedIndex = i
                Return
            End If
        Next
        
        ' Si non trouvé, afficher juste l'ID
        idrole.Text = roleId
    End Sub
End Class