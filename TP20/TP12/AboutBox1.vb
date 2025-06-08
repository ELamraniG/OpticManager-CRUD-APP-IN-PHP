Public NotInheritable Class AboutBox1

    Private Sub AboutBox1_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Me.Text = "A propos de LAPDUP"
        Me.LabelProductName.Text = "La paie du personnel"
        Me.LabelVersion.Text = "Version 1.0"
        Me.LabelCopyright.Text = My.Application.Info.Copyright
        Me.LabelCompanyName.Text = "Cours de VB.NET de Sup'ISI"
        'vbCrLf = saut de ligne
        Me.TextBoxDescription.Text = "Bienvenue sur LAPDUP," & vbCrLf & _
"votre solution complète pour la gestion efficace de la paie du personnel. Notre application est conçue pour simplifier et automatiser tous les aspects de la gestion de la paie, permettant à votre entreprise de gagner du temps et de réduire les erreurs." & _
vbCrLf & vbCrLf & "Avec [LAPDUP], vous pouvez facilement gérer les salaires, les heures travaillées, les congés, les déductions et bien plus encore, le tout à partir d'une seule plateforme conviviale. Notre équipe s'engage à vous offrir une expérience utilisateur exceptionnelle et un support client de qualité." & _
vbCrLf & vbCrLf & "Que vous soyez une petite entreprise ou une grande organisation, [LAPDUP] s'adapte à vos besoins spécifiques et évolue avec votre entreprise. Découvrez dès maintenant comment notre application peut simplifier la gestion de la paie de votre personnel et vous faire gagner en efficacité."
    End Sub

    Private Sub OKButton_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles OKButton.Click
        Me.Close()
    End Sub

    Private Sub TableLayoutPanel_Paint(ByVal sender As System.Object, ByVal e As System.Windows.Forms.PaintEventArgs) Handles TableLayoutPanel.Paint

    End Sub
End Class
