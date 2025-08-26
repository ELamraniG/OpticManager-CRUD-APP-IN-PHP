Imports System.Data.OleDb
Module Module1
    Public con As New OleDbConnection
    Public requete As String
    Public cmd As New OleDbCommand
    Public cmd2 As New OleDbCommand
    Public Sub connexion()
        con.ConnectionString = "Provider=Microsoft.ACE.OLEDB.12.0;Data Source=Gestion du personnel.accdb"
        con.Open()
    End Sub
    Public Sub cmdsql()
        cmd.Connection = con
        cmd.CommandText = requete
    End Sub
End Module
