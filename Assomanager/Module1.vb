Imports System.Data.OleDb
Module Module1
    Public con As New OleDbConnection
    Public requete As String
    Public cmd As New OleDbCommand
    Public da As OleDbDataAdapter ' Added Public declaration
    Public ds As DataSet         ' Added Public declaration

    Public Sub connexion()
        ' Close the connection if it's already open before setting a new connection string
        If con.State = ConnectionState.Open Then
            con.Close()
        End If
        con.ConnectionString = "Provider=Microsoft.ACE.OLEDB.12.0;Data Source=AssoManager.accdb"
        con.Open()
    End Sub

    Public Sub deconnexion()
        ' Close the connection if it's open
        If con.State = ConnectionState.Open Then
            con.Close()
        End If
    End Sub

    Public Sub cmdsql()
        cmd.Connection = con
        cmd.CommandText = requete
    End Sub
End Module
