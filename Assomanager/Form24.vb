Imports System.Data.OleDb
Imports System.IO

Public Class Form24

    Private Sub Form24_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Dim icone As New Icon("images/emp.ico") 'il faut placer emp.ico dans le dossier debug
        Me.Icon = icone
        Me.Text = "Formulaire Participant"
        Me.MinimizeBox = False
        Me.MaximizeBox = False
        Me.CenterToScreen()

        Try
            ' Load events into the dropdown
            connexion()
            requete = "SELECT idevenement, titre FROM evenements ORDER BY datedebut DESC"
            cmdsql()

            Dim data As IDataReader = Nothing
            Try
                idevenement.Items.Clear()
                data = cmd.ExecuteReader()

                While data.Read()
                    Dim eventId As String = data(0).ToString()
                    Dim eventTitle As String = data(1).ToString()
                    idevenement.Items.Add(eventId + " | " + eventTitle)
                End While
            Finally
                ' Always close the reader
                If data IsNot Nothing AndAlso Not data.IsClosed Then
                    data.Close()
                End If
                deconnexion()
            End Try

            ' Load members into the dropdown
            connexion()
            requete = "SELECT idmembre, nom, prenom FROM membres WHERE statut = 'actif' ORDER BY nom, prenom"
            cmdsql()

            Try
                idmembre.Items.Clear()
                data = cmd.ExecuteReader()

                While data.Read()
                    Dim membreId As String = data(0).ToString()
                    Dim membreName As String = data(1).ToString() & " " & data(2).ToString()
                    idmembre.Items.Add(membreId + " | " + membreName)
                End While
            Finally
                ' Always close the reader
                If data IsNot Nothing AndAlso Not data.IsClosed Then
                    data.Close()
                End If
                deconnexion()
            End Try

            ' Set default values for a new participant
            If type_operation.Text = "Ajouter" Then
                idparticipant.Text = ""
                idevenement.SelectedIndex = -1
                idmembre.SelectedIndex = -1
                statutpresence.SelectedIndex = 0 ' Default to "inscrit"
            End If

        Catch ex As Exception
            MsgBox("Erreur: " & ex.Message, vbExclamation, "Erreur de base de données")
            deconnexion()
        End Try
    End Sub

    Private Sub Save_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Save.Click
        ' Basic validation
        If idevenement.Text = "" Then
            MsgBox("Veuillez sélectionner un événement!", vbExclamation, "Message")
            idevenement.Focus()
            Exit Sub
        End If

        If idmembre.Text = "" Then
            MsgBox("Veuillez sélectionner un membre!", vbExclamation, "Message")
            idmembre.Focus()
            Exit Sub
        End If

        If statutpresence.Text = "" Then
            MsgBox("Veuillez sélectionner un statut de présence!", vbExclamation, "Message")
            statutpresence.Focus()
            Exit Sub
        End If

        Try
            ' Extract the event ID from the dropdown selection
            Dim eventId As String = ""
            If idevenement.Text.Contains("|") Then
                eventId = idevenement.Text.Substring(0, idevenement.Text.IndexOf("|")).Trim()
            Else
                eventId = idevenement.Text.Trim()
            End If

            ' Extract the member ID from the dropdown selection
            Dim membreId As String = ""
            If idmembre.Text.Contains("|") Then
                membreId = idmembre.Text.Substring(0, idmembre.Text.IndexOf("|")).Trim()
            Else
                membreId = idmembre.Text.Trim()
            End If

            ' If empty, show error
            If String.IsNullOrEmpty(eventId) Then
                MsgBox("Veuillez sélectionner un événement valide!", vbExclamation, "Message")
                idevenement.Focus()
                Exit Sub
            End If

            If String.IsNullOrEmpty(membreId) Then
                MsgBox("Veuillez sélectionner un membre valide!", vbExclamation, "Message")
                idmembre.Focus()
                Exit Sub
            End If

            Try
                connexion()

                If type_operation.Text = "Ajouter" Then
                    ' Check if this participant already exists for this event
                    requete = "SELECT COUNT(*) FROM participantevenements WHERE idevenement = ? AND idmembre = ?"
                    cmdsql()
                    cmd.Parameters.Clear()
                    cmd.Parameters.Add("@p1", OleDbType.Integer).Value = Convert.ToInt32(eventId)
                    cmd.Parameters.Add("@p2", OleDbType.Integer).Value = Convert.ToInt32(membreId)
                    
                    Dim count As Integer = Convert.ToInt32(cmd.ExecuteScalar())
                    
                    If count > 0 Then
                        MsgBox("Ce membre est déjà inscrit à cet événement!", vbExclamation, "Message")
                        deconnexion()
                        Exit Sub
                    End If

                    requete = "INSERT INTO participantevenements ([idevenement], [idmembre], [statutpresence]) VALUES (?,?,?)"
                    cmdsql()
                    cmd.Parameters.Clear()

                    cmd.Parameters.Add("@p1", OleDbType.Integer).Value = Convert.ToInt32(eventId)
                    cmd.Parameters.Add("@p2", OleDbType.Integer).Value = Convert.ToInt32(membreId)
                    cmd.Parameters.Add("@p3", OleDbType.VarChar).Value = statutpresence.Text
                Else ' Modifier
                    requete = "UPDATE participantevenements SET [idevenement]=?, [idmembre]=?, [statutpresence]=? WHERE [idparticipantevenement]=?"
                    cmdsql()
                    cmd.Parameters.Clear()

                    cmd.Parameters.Add("@p1", OleDbType.Integer).Value = Convert.ToInt32(eventId)
                    cmd.Parameters.Add("@p2", OleDbType.Integer).Value = Convert.ToInt32(membreId)
                    cmd.Parameters.Add("@p3", OleDbType.VarChar).Value = statutpresence.Text
                    cmd.Parameters.Add("@p4", OleDbType.Integer).Value = Convert.ToInt32(idparticipant.Text)
                End If

                cmd.ExecuteNonQuery()
            Finally
                ' Always ensure we close the connection
                deconnexion()
            End Try

            Form23.afficher_participants()
            Me.Close()
        Catch ex As Exception
            MsgBox("Erreur: " & ex.Message, vbExclamation, "Erreur SQL")
            deconnexion() ' Redundant but safe
        End Try
    End Sub

    ' Select an event by ID
    Public Sub SelectEventById(ByVal eventId As String)
        If String.IsNullOrEmpty(eventId) Then
            Return
        End If

        ' Look for the item that starts with the event ID
        For i As Integer = 0 To idevenement.Items.Count - 1
            Dim item As String = idevenement.Items(i).ToString()
            If item.StartsWith(eventId & " |") Then
                idevenement.SelectedIndex = i
                Return
            End If
        Next

        ' If not found, just display the ID
        idevenement.Text = eventId
    End Sub

    ' Select a member by ID
    Public Sub SelectMembreById(ByVal membreId As String)
        If String.IsNullOrEmpty(membreId) Then
            Return
        End If

        ' Look for the item that starts with the member ID
        For i As Integer = 0 To idmembre.Items.Count - 1
            Dim item As String = idmembre.Items(i).ToString()
            If item.StartsWith(membreId & " |") Then
                idmembre.SelectedIndex = i
                Return
            End If
        Next

        ' If not found, just display the ID
        idmembre.Text = membreId
    End Sub
End Class