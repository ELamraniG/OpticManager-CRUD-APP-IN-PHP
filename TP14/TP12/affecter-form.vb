Imports System.Data.OleDb

Public Class affecter_form

    Private Sub affecter_form_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Dim icone As New Icon("images/emp.ico") 'il faut placer emp.ico dans le dossier debug
        Me.Icon = icone
        Me.Text = "Formulaire Affecter un employé à un service "
        Me.MinimizeBox = False
        Me.MaximizeBox = False
        Me.CenterToScreen()
        '-----------------------------------------------------------
        '   Remplir le combobox des SERVICES
        '-----------------------------------------------------------
        connexion()
        requete = "select * from service"
        cmdsql()
        Dim data As IDataReader
        data = cmd.ExecuteReader()
        Dim ids, noms As String
        idservice.Items.Clear()
        While data.Read()
            ids = data(0).ToString
            noms = data(1)
            'remplir le combobox idservice
            idservice.Items.Add(ids + " | " + noms)
        End While
        con.Close()

        '-----------------------------------------------------------
        '   Remplir le combobox des EMPLOYES
        '-----------------------------------------------------------
        connexion()
        requete = "select * from employe where idemploye not in (select idemploye from affecter)"
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
        '-----------------------------------------------------------
        If type_operation.Text = "Ajouter" Then
            idservice.Text = Nothing
            idemploye.Text = Nothing
            datedebut.Text = Date.Now
            datefin.Text = Date.Now
        End If
        If type_operation.Text = "Modifier" Then
            If datefin_vide.Text = Nothing Then
                CheckBox1.Checked = False
                datefin.Visible = False
            Else
                CheckBox1.Checked = True
                datefin.Visible = True
            End If
        End If
    End Sub

    Private Sub Save_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Save.Click
        Dim dd As DateTime = datedebut.Value
        Dim df As DateTime = datefin.Value
        Dim result As Integer = DateTime.Compare(dd, df)
        If result >= 0 Then
            MsgBox("La date fin soit être supérieure à la date de début de l'affectation...", vbInformation, "Message")
        Else
            '-----------------------------------------------------------
            '   EXTRAIRE les IDE ET IDS des COMBOBOX
            '-----------------------------------------------------------
            Dim p As Integer
            Dim ids As String = Nothing
            Dim ide As String = 0
            If (idservice.SelectedIndex <> -1) Then
                p = InStr(idservice.Text, "|")
                ids = Mid(idservice.Text, 1, p - 1)
            End If
            If (idemploye.SelectedIndex <> -1) Then
                p = InStr(idemploye.Text, "|")
                ide = Mid(idemploye.Text, 1, p - 1)
            End If
            '-----------------------------------------------------------
            If type_operation.Text = "Ajouter" Then
                If CheckBox1.Checked = True Then
                    If (datefin.Text < datedebut.Text) Then
                        MsgBox("La date fin ne doit pas être inférieure à la date du début de l'affectation", vbExclamation, "Message")
                        Exit Sub
                    End If
                    requete = "insert into affecter values ('" + ids + "', " + ide + ", '" + datedebut.Text + "', '" + datefin.Text + "')"
                Else
                    requete = "insert into affecter values ('" + ids + "', " + ide + ", '" + datedebut.Text + "', null)"
                End If
            Else
                requete = "update affecter set "
                If ids = Nothing Then ids = ancien_idservice.Text
                Dim un As Integer = 0
                If ancien_idservice.Text <> ids Then
                    requete += "idservice = '" + ids + "'"
                    un = 1
                End If
                Dim anc_ide As Integer = CDbl(ancien_ide.Text)
                If un = 0 Then
                    requete += "datedebut = '" + datedebut.Text + "'"
                Else
                    requete += ", datedebut = '" + datedebut.Text + "'"
                End If

                If CheckBox1.Checked = True Then
                    If (datefin.Text < datedebut.Text) Then
                        MsgBox("La date fin ne doit pas être inférieure à la date du début de l'affectation", vbExclamation, "Message")
                        Exit Sub
                    Else
                        requete += ", datefin = '" + datefin.Text + "'"
                    End If
                Else
                    requete += ", datefin = null"
                End If
                requete += " where idservice = '" + ancien_idservice.Text + "' and idemploye = " & anc_ide
            End If

            connexion()
            cmdsql()
            cmd.ExecuteNonQuery()
            con.Close()
            affecter.afficher_affecter()
            con.Close()
            Me.Close()
        End If
    End Sub

    Private Sub CheckBox1_Click(ByVal sender As Object, ByVal e As System.EventArgs) Handles CheckBox1.Click
        If CheckBox1.Checked = False Then
            datefin.Visible = False
        Else
            datefin.Visible = True
        End If
    End Sub
End Class