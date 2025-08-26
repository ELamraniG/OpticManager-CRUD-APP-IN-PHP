<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class menu
    Inherits System.Windows.Forms.Form

    'Form remplace la méthode Dispose pour nettoyer la liste des composants.
    <System.Diagnostics.DebuggerNonUserCode()> _
    Protected Overrides Sub Dispose(ByVal disposing As Boolean)
        Try
            If disposing AndAlso components IsNot Nothing Then
                components.Dispose()
            End If
        Finally
            MyBase.Dispose(disposing)
        End Try
    End Sub

    'Requise par le Concepteur Windows Form
    Private components As System.ComponentModel.IContainer

    'REMARQUE : la procédure suivante est requise par le Concepteur Windows Form
    'Elle peut être modifiée à l'aide du Concepteur Windows Form.  
    'Ne la modifiez pas à l'aide de l'éditeur de code.
    <System.Diagnostics.DebuggerStepThrough()> _
    Private Sub InitializeComponent()
        Me.components = New System.ComponentModel.Container()
        Dim resources As System.ComponentModel.ComponentResourceManager = New System.ComponentModel.ComponentResourceManager(GetType(menu))
        Me.StatusStrip1 = New System.Windows.Forms.StatusStrip()
        Me.ToolStripStatusLabel1 = New System.Windows.Forms.ToolStripStatusLabel()
        Me.ToolStripStatusLabel2 = New System.Windows.Forms.ToolStripStatusLabel()
        Me.MenuStrip1 = New System.Windows.Forms.MenuStrip()
        Me.AccueilToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.DéconnecterToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.ToolStripSeparator9 = New System.Windows.Forms.ToolStripSeparator()
        Me.QuitterToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.OrganisationToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.GestionDesServicesToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.ToolStripSeparator1 = New System.Windows.Forms.ToolStripSeparator()
        Me.GestionDesEmployésToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.ToolStripSeparator2 = New System.Windows.Forms.ToolStripSeparator()
        Me.AffecttationDeSemployésToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.PointageToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.PointageIndividuelToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.PointageAutomatiqueToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.RapportsToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.RapportDePointageToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.LesPointagesDunEmployéToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.LesPointagesDunServiceToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.RapportDaffectaionToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.EtatDesServicesToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.ToolStripSeparator8 = New System.Windows.Forms.ToolStripSeparator()
        Me.EtatDesEmployésParServiceToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.ParamètresToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.GestionDesUtilisateursToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.ToolStripSeparator10 = New System.Windows.Forms.ToolStripSeparator()
        Me.ConfigurationDeLapplicationToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.ToolStripSeparator11 = New System.Windows.Forms.ToolStripSeparator()
        Me.barredoutils = New System.Windows.Forms.ToolStripMenuItem()
        Me.AideToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.AideEnLigneToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.TutorielsVidéoToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.FAQToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.SupportTechniqueToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.MisesÀJourEtNouveautésToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.SignalerUnProblèmeToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.ToolStripSeparator13 = New System.Windows.Forms.ToolStripSeparator()
        Me.PolitiqueDeConfidentialitéToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.ToolStripSeparator14 = New System.Windows.Forms.ToolStripSeparator()
        Me.ConditionsDutilisationToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.ToolStripSeparator12 = New System.Windows.Forms.ToolStripSeparator()
        Me.AProposToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem()
        Me.ToolStrip1 = New System.Windows.Forms.ToolStrip()
        Me.service = New System.Windows.Forms.ToolStripButton()
        Me.ToolStripSeparator3 = New System.Windows.Forms.ToolStripSeparator()
        Me.employe = New System.Windows.Forms.ToolStripButton()
        Me.ToolStripSeparator4 = New System.Windows.Forms.ToolStripSeparator()
        Me.affecter = New System.Windows.Forms.ToolStripButton()
        Me.ToolStripSeparator5 = New System.Windows.Forms.ToolStripSeparator()
        Me.pointageindividuel = New System.Windows.Forms.ToolStripButton()
        Me.ToolStripSeparator6 = New System.Windows.Forms.ToolStripSeparator()
        Me.pauto = New System.Windows.Forms.ToolStripButton()
        Me.ToolStripSeparator7 = New System.Windows.Forms.ToolStripSeparator()
        Me.ToolStripButton6 = New System.Windows.Forms.ToolStripButton()
        Me.tsigle = New System.Windows.Forms.Label()
        Me.tnomentreprise = New System.Windows.Forms.Label()
        Me.panelservice = New System.Windows.Forms.Panel()
        Me.Label1 = New System.Windows.Forms.Label()
        Me.cptservice = New System.Windows.Forms.Label()
        Me.panelemploye = New System.Windows.Forms.Panel()
        Me.Label2 = New System.Windows.Forms.Label()
        Me.cptemploye = New System.Windows.Forms.Label()
        Me.panelaffectation = New System.Windows.Forms.Panel()
        Me.Label3 = New System.Windows.Forms.Label()
        Me.cptaffectation = New System.Windows.Forms.Label()
        Me.panelpointage = New System.Windows.Forms.Panel()
        Me.Label4 = New System.Windows.Forms.Label()
        Me.cptpointage = New System.Windows.Forms.Label()
        Me.paneldateheure = New System.Windows.Forms.Panel()
        Me.typeuser = New System.Windows.Forms.Label()
        Me.prenomuser = New System.Windows.Forms.Label()
        Me.nomuser = New System.Windows.Forms.Label()
        Me.joursysteme = New System.Windows.Forms.Label()
        Me.heuresysteme = New System.Windows.Forms.Label()
        Me.datesysteme = New System.Windows.Forms.Label()
        Me.Timer1 = New System.Windows.Forms.Timer(Me.components)
        Me.panelauthentification = New System.Windows.Forms.Panel()
        Me.Fermer = New System.Windows.Forms.Button()
        Me.seconnecter = New System.Windows.Forms.Button()
        Me.motdepasse = New System.Windows.Forms.TextBox()
        Me.Label6 = New System.Windows.Forms.Label()
        Me.login = New System.Windows.Forms.TextBox()
        Me.Label5 = New System.Windows.Forms.Label()
        Me.panelutilisateur = New System.Windows.Forms.Panel()
        Me.Label7 = New System.Windows.Forms.Label()
        Me.cptutilisateur = New System.Windows.Forms.Label()
        Me.StatusStrip1.SuspendLayout()
        Me.MenuStrip1.SuspendLayout()
        Me.ToolStrip1.SuspendLayout()
        Me.panelservice.SuspendLayout()
        Me.panelemploye.SuspendLayout()
        Me.panelaffectation.SuspendLayout()
        Me.panelpointage.SuspendLayout()
        Me.paneldateheure.SuspendLayout()
        Me.panelauthentification.SuspendLayout()
        Me.panelutilisateur.SuspendLayout()
        Me.SuspendLayout()
        '
        'StatusStrip1
        '
        Me.StatusStrip1.Items.AddRange(New System.Windows.Forms.ToolStripItem() {Me.ToolStripStatusLabel1, Me.ToolStripStatusLabel2})
        Me.StatusStrip1.Location = New System.Drawing.Point(0, 822)
        Me.StatusStrip1.Name = "StatusStrip1"
        Me.StatusStrip1.Padding = New System.Windows.Forms.Padding(2, 0, 14, 0)
        Me.StatusStrip1.Size = New System.Drawing.Size(1579, 30)
        Me.StatusStrip1.TabIndex = 16
        '
        'ToolStripStatusLabel1
        '
        Me.ToolStripStatusLabel1.Name = "ToolStripStatusLabel1"
        Me.ToolStripStatusLabel1.Size = New System.Drawing.Size(176, 25)
        Me.ToolStripStatusLabel1.Text = "La paie du personnel"
        '
        'ToolStripStatusLabel2
        '
        Me.ToolStripStatusLabel2.Name = "ToolStripStatusLabel2"
        Me.ToolStripStatusLabel2.Size = New System.Drawing.Size(223, 25)
        Me.ToolStripStatusLabel2.Text = "ESPACE ADMINISTRATEUR"
        '
        'MenuStrip1
        '
        Me.MenuStrip1.Items.AddRange(New System.Windows.Forms.ToolStripItem() {Me.AccueilToolStripMenuItem, Me.OrganisationToolStripMenuItem, Me.PointageToolStripMenuItem, Me.RapportsToolStripMenuItem, Me.ParamètresToolStripMenuItem, Me.AideToolStripMenuItem})
        Me.MenuStrip1.Location = New System.Drawing.Point(0, 0)
        Me.MenuStrip1.Name = "MenuStrip1"
        Me.MenuStrip1.Size = New System.Drawing.Size(1579, 33)
        Me.MenuStrip1.TabIndex = 17
        Me.MenuStrip1.Text = "MenuStrip1"
        '
        'AccueilToolStripMenuItem
        '
        Me.AccueilToolStripMenuItem.DropDownItems.AddRange(New System.Windows.Forms.ToolStripItem() {Me.DéconnecterToolStripMenuItem, Me.ToolStripSeparator9, Me.QuitterToolStripMenuItem})
        Me.AccueilToolStripMenuItem.Image = CType(resources.GetObject("AccueilToolStripMenuItem.Image"), System.Drawing.Image)
        Me.AccueilToolStripMenuItem.Name = "AccueilToolStripMenuItem"
        Me.AccueilToolStripMenuItem.Size = New System.Drawing.Size(95, 29)
        Me.AccueilToolStripMenuItem.Text = "Accueil"
        '
        'DéconnecterToolStripMenuItem
        '
        Me.DéconnecterToolStripMenuItem.Name = "DéconnecterToolStripMenuItem"
        Me.DéconnecterToolStripMenuItem.Size = New System.Drawing.Size(183, 30)
        Me.DéconnecterToolStripMenuItem.Text = "Déconnecter"
        '
        'ToolStripSeparator9
        '
        Me.ToolStripSeparator9.Name = "ToolStripSeparator9"
        Me.ToolStripSeparator9.Size = New System.Drawing.Size(180, 6)
        '
        'QuitterToolStripMenuItem
        '
        Me.QuitterToolStripMenuItem.Name = "QuitterToolStripMenuItem"
        Me.QuitterToolStripMenuItem.Size = New System.Drawing.Size(183, 30)
        Me.QuitterToolStripMenuItem.Text = "Quitter"
        '
        'OrganisationToolStripMenuItem
        '
        Me.OrganisationToolStripMenuItem.DropDownItems.AddRange(New System.Windows.Forms.ToolStripItem() {Me.GestionDesServicesToolStripMenuItem, Me.ToolStripSeparator1, Me.GestionDesEmployésToolStripMenuItem, Me.ToolStripSeparator2, Me.AffecttationDeSemployésToolStripMenuItem})
        Me.OrganisationToolStripMenuItem.Name = "OrganisationToolStripMenuItem"
        Me.OrganisationToolStripMenuItem.Size = New System.Drawing.Size(126, 29)
        Me.OrganisationToolStripMenuItem.Text = "Organisation"
        '
        'GestionDesServicesToolStripMenuItem
        '
        Me.GestionDesServicesToolStripMenuItem.Image = CType(resources.GetObject("GestionDesServicesToolStripMenuItem.Image"), System.Drawing.Image)
        Me.GestionDesServicesToolStripMenuItem.Name = "GestionDesServicesToolStripMenuItem"
        Me.GestionDesServicesToolStripMenuItem.Size = New System.Drawing.Size(286, 30)
        Me.GestionDesServicesToolStripMenuItem.Text = "Gestion des services"
        '
        'ToolStripSeparator1
        '
        Me.ToolStripSeparator1.Name = "ToolStripSeparator1"
        Me.ToolStripSeparator1.Size = New System.Drawing.Size(283, 6)
        '
        'GestionDesEmployésToolStripMenuItem
        '
        Me.GestionDesEmployésToolStripMenuItem.Image = CType(resources.GetObject("GestionDesEmployésToolStripMenuItem.Image"), System.Drawing.Image)
        Me.GestionDesEmployésToolStripMenuItem.Name = "GestionDesEmployésToolStripMenuItem"
        Me.GestionDesEmployésToolStripMenuItem.Size = New System.Drawing.Size(286, 30)
        Me.GestionDesEmployésToolStripMenuItem.Text = "Gestion des employés"
        '
        'ToolStripSeparator2
        '
        Me.ToolStripSeparator2.Name = "ToolStripSeparator2"
        Me.ToolStripSeparator2.Size = New System.Drawing.Size(283, 6)
        '
        'AffecttationDeSemployésToolStripMenuItem
        '
        Me.AffecttationDeSemployésToolStripMenuItem.Image = CType(resources.GetObject("AffecttationDeSemployésToolStripMenuItem.Image"), System.Drawing.Image)
        Me.AffecttationDeSemployésToolStripMenuItem.Name = "AffecttationDeSemployésToolStripMenuItem"
        Me.AffecttationDeSemployésToolStripMenuItem.Size = New System.Drawing.Size(286, 30)
        Me.AffecttationDeSemployésToolStripMenuItem.Text = "Affectation des employés"
        '
        'PointageToolStripMenuItem
        '
        Me.PointageToolStripMenuItem.DropDownItems.AddRange(New System.Windows.Forms.ToolStripItem() {Me.PointageIndividuelToolStripMenuItem, Me.PointageAutomatiqueToolStripMenuItem})
        Me.PointageToolStripMenuItem.Image = CType(resources.GetObject("PointageToolStripMenuItem.Image"), System.Drawing.Image)
        Me.PointageToolStripMenuItem.Name = "PointageToolStripMenuItem"
        Me.PointageToolStripMenuItem.Size = New System.Drawing.Size(109, 29)
        Me.PointageToolStripMenuItem.Text = "Pointage"
        '
        'PointageIndividuelToolStripMenuItem
        '
        Me.PointageIndividuelToolStripMenuItem.Name = "PointageIndividuelToolStripMenuItem"
        Me.PointageIndividuelToolStripMenuItem.Size = New System.Drawing.Size(320, 30)
        Me.PointageIndividuelToolStripMenuItem.Text = "Pointage individuel"
        '
        'PointageAutomatiqueToolStripMenuItem
        '
        Me.PointageAutomatiqueToolStripMenuItem.Image = CType(resources.GetObject("PointageAutomatiqueToolStripMenuItem.Image"), System.Drawing.Image)
        Me.PointageAutomatiqueToolStripMenuItem.Name = "PointageAutomatiqueToolStripMenuItem"
        Me.PointageAutomatiqueToolStripMenuItem.ShortcutKeys = CType((System.Windows.Forms.Keys.Control Or System.Windows.Forms.Keys.P), System.Windows.Forms.Keys)
        Me.PointageAutomatiqueToolStripMenuItem.Size = New System.Drawing.Size(320, 30)
        Me.PointageAutomatiqueToolStripMenuItem.Text = "Pointage automatique"
        '
        'RapportsToolStripMenuItem
        '
        Me.RapportsToolStripMenuItem.DropDownItems.AddRange(New System.Windows.Forms.ToolStripItem() {Me.RapportDePointageToolStripMenuItem, Me.RapportDaffectaionToolStripMenuItem})
        Me.RapportsToolStripMenuItem.Image = CType(resources.GetObject("RapportsToolStripMenuItem.Image"), System.Drawing.Image)
        Me.RapportsToolStripMenuItem.Name = "RapportsToolStripMenuItem"
        Me.RapportsToolStripMenuItem.Size = New System.Drawing.Size(113, 29)
        Me.RapportsToolStripMenuItem.Text = "Rapports"
        '
        'RapportDePointageToolStripMenuItem
        '
        Me.RapportDePointageToolStripMenuItem.DropDownItems.AddRange(New System.Windows.Forms.ToolStripItem() {Me.LesPointagesDunEmployéToolStripMenuItem, Me.LesPointagesDunServiceToolStripMenuItem})
        Me.RapportDePointageToolStripMenuItem.Name = "RapportDePointageToolStripMenuItem"
        Me.RapportDePointageToolStripMenuItem.Size = New System.Drawing.Size(253, 30)
        Me.RapportDePointageToolStripMenuItem.Text = "Rapport de pointage"
        '
        'LesPointagesDunEmployéToolStripMenuItem
        '
        Me.LesPointagesDunEmployéToolStripMenuItem.Name = "LesPointagesDunEmployéToolStripMenuItem"
        Me.LesPointagesDunEmployéToolStripMenuItem.Size = New System.Drawing.Size(307, 30)
        Me.LesPointagesDunEmployéToolStripMenuItem.Text = "Les pointages d'un employé"
        '
        'LesPointagesDunServiceToolStripMenuItem
        '
        Me.LesPointagesDunServiceToolStripMenuItem.Name = "LesPointagesDunServiceToolStripMenuItem"
        Me.LesPointagesDunServiceToolStripMenuItem.Size = New System.Drawing.Size(307, 30)
        Me.LesPointagesDunServiceToolStripMenuItem.Text = "Les pointages d'un service"
        '
        'RapportDaffectaionToolStripMenuItem
        '
        Me.RapportDaffectaionToolStripMenuItem.DropDownItems.AddRange(New System.Windows.Forms.ToolStripItem() {Me.EtatDesServicesToolStripMenuItem, Me.ToolStripSeparator8, Me.EtatDesEmployésParServiceToolStripMenuItem})
        Me.RapportDaffectaionToolStripMenuItem.Name = "RapportDaffectaionToolStripMenuItem"
        Me.RapportDaffectaionToolStripMenuItem.Size = New System.Drawing.Size(253, 30)
        Me.RapportDaffectaionToolStripMenuItem.Text = "Rapport d'affectation"
        '
        'EtatDesServicesToolStripMenuItem
        '
        Me.EtatDesServicesToolStripMenuItem.Name = "EtatDesServicesToolStripMenuItem"
        Me.EtatDesServicesToolStripMenuItem.Size = New System.Drawing.Size(320, 30)
        Me.EtatDesServicesToolStripMenuItem.Text = "Les employés d'un service"
        '
        'ToolStripSeparator8
        '
        Me.ToolStripSeparator8.Name = "ToolStripSeparator8"
        Me.ToolStripSeparator8.Size = New System.Drawing.Size(317, 6)
        '
        'EtatDesEmployésParServiceToolStripMenuItem
        '
        Me.EtatDesEmployésParServiceToolStripMenuItem.Name = "EtatDesEmployésParServiceToolStripMenuItem"
        Me.EtatDesEmployésParServiceToolStripMenuItem.Size = New System.Drawing.Size(320, 30)
        Me.EtatDesEmployésParServiceToolStripMenuItem.Text = "Les affectations d'un employé"
        '
        'ParamètresToolStripMenuItem
        '
        Me.ParamètresToolStripMenuItem.DropDownItems.AddRange(New System.Windows.Forms.ToolStripItem() {Me.GestionDesUtilisateursToolStripMenuItem, Me.ToolStripSeparator10, Me.ConfigurationDeLapplicationToolStripMenuItem, Me.ToolStripSeparator11, Me.barredoutils})
        Me.ParamètresToolStripMenuItem.Image = CType(resources.GetObject("ParamètresToolStripMenuItem.Image"), System.Drawing.Image)
        Me.ParamètresToolStripMenuItem.Name = "ParamètresToolStripMenuItem"
        Me.ParamètresToolStripMenuItem.Size = New System.Drawing.Size(127, 29)
        Me.ParamètresToolStripMenuItem.Text = "Paramètres"
        '
        'GestionDesUtilisateursToolStripMenuItem
        '
        Me.GestionDesUtilisateursToolStripMenuItem.Name = "GestionDesUtilisateursToolStripMenuItem"
        Me.GestionDesUtilisateursToolStripMenuItem.Size = New System.Drawing.Size(318, 30)
        Me.GestionDesUtilisateursToolStripMenuItem.Text = "Gestion des utilisateurs"
        '
        'ToolStripSeparator10
        '
        Me.ToolStripSeparator10.Name = "ToolStripSeparator10"
        Me.ToolStripSeparator10.Size = New System.Drawing.Size(315, 6)
        '
        'ConfigurationDeLapplicationToolStripMenuItem
        '
        Me.ConfigurationDeLapplicationToolStripMenuItem.Name = "ConfigurationDeLapplicationToolStripMenuItem"
        Me.ConfigurationDeLapplicationToolStripMenuItem.Size = New System.Drawing.Size(318, 30)
        Me.ConfigurationDeLapplicationToolStripMenuItem.Text = "Configuration de l'application"
        '
        'ToolStripSeparator11
        '
        Me.ToolStripSeparator11.Name = "ToolStripSeparator11"
        Me.ToolStripSeparator11.Size = New System.Drawing.Size(315, 6)
        '
        'barredoutils
        '
        Me.barredoutils.Name = "barredoutils"
        Me.barredoutils.Size = New System.Drawing.Size(318, 30)
        Me.barredoutils.Text = "Barre d'outils"
        '
        'AideToolStripMenuItem
        '
        Me.AideToolStripMenuItem.DropDownItems.AddRange(New System.Windows.Forms.ToolStripItem() {Me.AideEnLigneToolStripMenuItem, Me.TutorielsVidéoToolStripMenuItem, Me.FAQToolStripMenuItem, Me.SupportTechniqueToolStripMenuItem, Me.MisesÀJourEtNouveautésToolStripMenuItem, Me.SignalerUnProblèmeToolStripMenuItem, Me.ToolStripSeparator13, Me.PolitiqueDeConfidentialitéToolStripMenuItem, Me.ToolStripSeparator14, Me.ConditionsDutilisationToolStripMenuItem, Me.ToolStripSeparator12, Me.AProposToolStripMenuItem})
        Me.AideToolStripMenuItem.Image = CType(resources.GetObject("AideToolStripMenuItem.Image"), System.Drawing.Image)
        Me.AideToolStripMenuItem.Name = "AideToolStripMenuItem"
        Me.AideToolStripMenuItem.Size = New System.Drawing.Size(76, 29)
        Me.AideToolStripMenuItem.Text = "Aide"
        '
        'AideEnLigneToolStripMenuItem
        '
        Me.AideEnLigneToolStripMenuItem.Name = "AideEnLigneToolStripMenuItem"
        Me.AideEnLigneToolStripMenuItem.Size = New System.Drawing.Size(295, 30)
        Me.AideEnLigneToolStripMenuItem.Text = "Aide en ligne"
        '
        'TutorielsVidéoToolStripMenuItem
        '
        Me.TutorielsVidéoToolStripMenuItem.Name = "TutorielsVidéoToolStripMenuItem"
        Me.TutorielsVidéoToolStripMenuItem.Size = New System.Drawing.Size(295, 30)
        Me.TutorielsVidéoToolStripMenuItem.Text = "Tutoriels vidéo"
        '
        'FAQToolStripMenuItem
        '
        Me.FAQToolStripMenuItem.Name = "FAQToolStripMenuItem"
        Me.FAQToolStripMenuItem.Size = New System.Drawing.Size(295, 30)
        Me.FAQToolStripMenuItem.Text = "FAQ"
        '
        'SupportTechniqueToolStripMenuItem
        '
        Me.SupportTechniqueToolStripMenuItem.Name = "SupportTechniqueToolStripMenuItem"
        Me.SupportTechniqueToolStripMenuItem.Size = New System.Drawing.Size(295, 30)
        Me.SupportTechniqueToolStripMenuItem.Text = "Support technique"
        '
        'MisesÀJourEtNouveautésToolStripMenuItem
        '
        Me.MisesÀJourEtNouveautésToolStripMenuItem.Name = "MisesÀJourEtNouveautésToolStripMenuItem"
        Me.MisesÀJourEtNouveautésToolStripMenuItem.Size = New System.Drawing.Size(295, 30)
        Me.MisesÀJourEtNouveautésToolStripMenuItem.Text = "Mises à jour et nouveautés"
        '
        'SignalerUnProblèmeToolStripMenuItem
        '
        Me.SignalerUnProblèmeToolStripMenuItem.Name = "SignalerUnProblèmeToolStripMenuItem"
        Me.SignalerUnProblèmeToolStripMenuItem.Size = New System.Drawing.Size(295, 30)
        Me.SignalerUnProblèmeToolStripMenuItem.Text = "Signaler un problème"
        '
        'ToolStripSeparator13
        '
        Me.ToolStripSeparator13.Name = "ToolStripSeparator13"
        Me.ToolStripSeparator13.Size = New System.Drawing.Size(292, 6)
        '
        'PolitiqueDeConfidentialitéToolStripMenuItem
        '
        Me.PolitiqueDeConfidentialitéToolStripMenuItem.Name = "PolitiqueDeConfidentialitéToolStripMenuItem"
        Me.PolitiqueDeConfidentialitéToolStripMenuItem.Size = New System.Drawing.Size(295, 30)
        Me.PolitiqueDeConfidentialitéToolStripMenuItem.Text = "Politique de confidentialité"
        '
        'ToolStripSeparator14
        '
        Me.ToolStripSeparator14.Name = "ToolStripSeparator14"
        Me.ToolStripSeparator14.Size = New System.Drawing.Size(292, 6)
        '
        'ConditionsDutilisationToolStripMenuItem
        '
        Me.ConditionsDutilisationToolStripMenuItem.Name = "ConditionsDutilisationToolStripMenuItem"
        Me.ConditionsDutilisationToolStripMenuItem.Size = New System.Drawing.Size(295, 30)
        Me.ConditionsDutilisationToolStripMenuItem.Text = "Conditions d'utilisation"
        '
        'ToolStripSeparator12
        '
        Me.ToolStripSeparator12.Name = "ToolStripSeparator12"
        Me.ToolStripSeparator12.Size = New System.Drawing.Size(292, 6)
        '
        'AProposToolStripMenuItem
        '
        Me.AProposToolStripMenuItem.Name = "AProposToolStripMenuItem"
        Me.AProposToolStripMenuItem.Size = New System.Drawing.Size(295, 30)
        Me.AProposToolStripMenuItem.Text = "A propos"
        '
        'ToolStrip1
        '
        Me.ToolStrip1.ImageScalingSize = New System.Drawing.Size(48, 48)
        Me.ToolStrip1.Items.AddRange(New System.Windows.Forms.ToolStripItem() {Me.service, Me.ToolStripSeparator3, Me.employe, Me.ToolStripSeparator4, Me.affecter, Me.ToolStripSeparator5, Me.pointageindividuel, Me.ToolStripSeparator6, Me.pauto, Me.ToolStripSeparator7, Me.ToolStripButton6})
        Me.ToolStrip1.Location = New System.Drawing.Point(0, 33)
        Me.ToolStrip1.Name = "ToolStrip1"
        Me.ToolStrip1.Size = New System.Drawing.Size(1579, 55)
        Me.ToolStrip1.TabIndex = 18
        Me.ToolStrip1.Text = "ToolStrip1"
        '
        'service
        '
        Me.service.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Image
        Me.service.Image = CType(resources.GetObject("service.Image"), System.Drawing.Image)
        Me.service.ImageTransparentColor = System.Drawing.Color.Magenta
        Me.service.Name = "service"
        Me.service.Size = New System.Drawing.Size(52, 52)
        Me.service.Text = "Gestion des services"
        Me.service.TextAlign = System.Drawing.ContentAlignment.BottomCenter
        '
        'ToolStripSeparator3
        '
        Me.ToolStripSeparator3.Name = "ToolStripSeparator3"
        Me.ToolStripSeparator3.Size = New System.Drawing.Size(6, 55)
        '
        'employe
        '
        Me.employe.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Image
        Me.employe.Image = CType(resources.GetObject("employe.Image"), System.Drawing.Image)
        Me.employe.ImageTransparentColor = System.Drawing.Color.Magenta
        Me.employe.Name = "employe"
        Me.employe.Size = New System.Drawing.Size(52, 52)
        Me.employe.Text = "Gestion des employés"
        '
        'ToolStripSeparator4
        '
        Me.ToolStripSeparator4.Name = "ToolStripSeparator4"
        Me.ToolStripSeparator4.Size = New System.Drawing.Size(6, 55)
        '
        'affecter
        '
        Me.affecter.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Image
        Me.affecter.Image = CType(resources.GetObject("affecter.Image"), System.Drawing.Image)
        Me.affecter.ImageTransparentColor = System.Drawing.Color.Magenta
        Me.affecter.Name = "affecter"
        Me.affecter.Size = New System.Drawing.Size(52, 52)
        Me.affecter.Text = "Affectation"
        '
        'ToolStripSeparator5
        '
        Me.ToolStripSeparator5.Name = "ToolStripSeparator5"
        Me.ToolStripSeparator5.Size = New System.Drawing.Size(6, 55)
        '
        'pointageindividuel
        '
        Me.pointageindividuel.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Image
        Me.pointageindividuel.Image = CType(resources.GetObject("pointageindividuel.Image"), System.Drawing.Image)
        Me.pointageindividuel.ImageTransparentColor = System.Drawing.Color.Magenta
        Me.pointageindividuel.Name = "pointageindividuel"
        Me.pointageindividuel.Size = New System.Drawing.Size(52, 52)
        Me.pointageindividuel.Text = "Pointage individuel"
        '
        'ToolStripSeparator6
        '
        Me.ToolStripSeparator6.Name = "ToolStripSeparator6"
        Me.ToolStripSeparator6.Size = New System.Drawing.Size(6, 55)
        '
        'pauto
        '
        Me.pauto.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Image
        Me.pauto.Image = CType(resources.GetObject("pauto.Image"), System.Drawing.Image)
        Me.pauto.ImageTransparentColor = System.Drawing.Color.Magenta
        Me.pauto.Name = "pauto"
        Me.pauto.Size = New System.Drawing.Size(52, 52)
        Me.pauto.Text = "Pointage Automatique"
        '
        'ToolStripSeparator7
        '
        Me.ToolStripSeparator7.Name = "ToolStripSeparator7"
        Me.ToolStripSeparator7.Size = New System.Drawing.Size(6, 55)
        '
        'ToolStripButton6
        '
        Me.ToolStripButton6.Alignment = System.Windows.Forms.ToolStripItemAlignment.Right
        Me.ToolStripButton6.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Image
        Me.ToolStripButton6.Image = CType(resources.GetObject("ToolStripButton6.Image"), System.Drawing.Image)
        Me.ToolStripButton6.ImageTransparentColor = System.Drawing.Color.Magenta
        Me.ToolStripButton6.Name = "ToolStripButton6"
        Me.ToolStripButton6.Size = New System.Drawing.Size(52, 52)
        Me.ToolStripButton6.Text = "Quitter"
        '
        'tsigle
        '
        Me.tsigle.AutoSize = True
        Me.tsigle.BackColor = System.Drawing.Color.Transparent
        Me.tsigle.Font = New System.Drawing.Font("Microsoft Sans Serif", 10.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.tsigle.Location = New System.Drawing.Point(12, 593)
        Me.tsigle.Name = "tsigle"
        Me.tsigle.Size = New System.Drawing.Size(57, 25)
        Me.tsigle.TabIndex = 19
        Me.tsigle.Text = "tsigle"
        '
        'tnomentreprise
        '
        Me.tnomentreprise.AutoSize = True
        Me.tnomentreprise.BackColor = System.Drawing.Color.Transparent
        Me.tnomentreprise.Font = New System.Drawing.Font("Microsoft Sans Serif", 10.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.tnomentreprise.Location = New System.Drawing.Point(12, 623)
        Me.tnomentreprise.Name = "tnomentreprise"
        Me.tnomentreprise.Size = New System.Drawing.Size(141, 25)
        Me.tnomentreprise.TabIndex = 20
        Me.tnomentreprise.Text = "tnomentreprise"
        '
        'panelservice
        '
        Me.panelservice.BackColor = System.Drawing.Color.FromArgb(CType(CType(192, Byte), Integer), CType(CType(255, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.panelservice.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle
        Me.panelservice.Controls.Add(Me.Label1)
        Me.panelservice.Controls.Add(Me.cptservice)
        Me.panelservice.Location = New System.Drawing.Point(92, 160)
        Me.panelservice.Name = "panelservice"
        Me.panelservice.Size = New System.Drawing.Size(229, 123)
        Me.panelservice.TabIndex = 23
        '
        'Label1
        '
        Me.Label1.AutoSize = True
        Me.Label1.Font = New System.Drawing.Font("Microsoft Sans Serif", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label1.Location = New System.Drawing.Point(12, 62)
        Me.Label1.Name = "Label1"
        Me.Label1.Size = New System.Drawing.Size(94, 29)
        Me.Label1.TabIndex = 24
        Me.Label1.Text = "Service"
        '
        'cptservice
        '
        Me.cptservice.AutoSize = True
        Me.cptservice.Font = New System.Drawing.Font("Microsoft Sans Serif", 20.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.cptservice.Location = New System.Drawing.Point(9, 16)
        Me.cptservice.Name = "cptservice"
        Me.cptservice.Size = New System.Drawing.Size(139, 46)
        Me.cptservice.TabIndex = 23
        Me.cptservice.Text = "Label1"
        '
        'panelemploye
        '
        Me.panelemploye.BackColor = System.Drawing.Color.FromArgb(CType(CType(255, Byte), Integer), CType(CType(192, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.panelemploye.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle
        Me.panelemploye.Controls.Add(Me.Label2)
        Me.panelemploye.Controls.Add(Me.cptemploye)
        Me.panelemploye.Location = New System.Drawing.Point(347, 160)
        Me.panelemploye.Name = "panelemploye"
        Me.panelemploye.Size = New System.Drawing.Size(229, 123)
        Me.panelemploye.TabIndex = 25
        '
        'Label2
        '
        Me.Label2.AutoSize = True
        Me.Label2.Font = New System.Drawing.Font("Microsoft Sans Serif", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label2.Location = New System.Drawing.Point(6, 62)
        Me.Label2.Name = "Label2"
        Me.Label2.Size = New System.Drawing.Size(108, 29)
        Me.Label2.TabIndex = 24
        Me.Label2.Text = "Employé"
        '
        'cptemploye
        '
        Me.cptemploye.AutoSize = True
        Me.cptemploye.Font = New System.Drawing.Font("Microsoft Sans Serif", 20.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.cptemploye.Location = New System.Drawing.Point(3, 13)
        Me.cptemploye.Name = "cptemploye"
        Me.cptemploye.Size = New System.Drawing.Size(225, 46)
        Me.cptemploye.TabIndex = 23
        Me.cptemploye.Text = "cptemploye"
        '
        'panelaffectation
        '
        Me.panelaffectation.BackColor = System.Drawing.Color.FromArgb(CType(CType(255, Byte), Integer), CType(CType(192, Byte), Integer), CType(CType(128, Byte), Integer))
        Me.panelaffectation.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle
        Me.panelaffectation.Controls.Add(Me.Label3)
        Me.panelaffectation.Controls.Add(Me.cptaffectation)
        Me.panelaffectation.Location = New System.Drawing.Point(604, 160)
        Me.panelaffectation.Name = "panelaffectation"
        Me.panelaffectation.Size = New System.Drawing.Size(229, 123)
        Me.panelaffectation.TabIndex = 26
        '
        'Label3
        '
        Me.Label3.AutoSize = True
        Me.Label3.Font = New System.Drawing.Font("Microsoft Sans Serif", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label3.Location = New System.Drawing.Point(6, 62)
        Me.Label3.Name = "Label3"
        Me.Label3.Size = New System.Drawing.Size(124, 29)
        Me.Label3.TabIndex = 24
        Me.Label3.Text = "Affectation"
        '
        'cptaffectation
        '
        Me.cptaffectation.AutoSize = True
        Me.cptaffectation.Font = New System.Drawing.Font("Microsoft Sans Serif", 20.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.cptaffectation.Location = New System.Drawing.Point(3, 13)
        Me.cptaffectation.Name = "cptaffectation"
        Me.cptaffectation.Size = New System.Drawing.Size(259, 46)
        Me.cptaffectation.TabIndex = 23
        Me.cptaffectation.Text = "cptaffectation"
        '
        'panelpointage
        '
        Me.panelpointage.BackColor = System.Drawing.Color.Silver
        Me.panelpointage.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle
        Me.panelpointage.Controls.Add(Me.Label4)
        Me.panelpointage.Controls.Add(Me.cptpointage)
        Me.panelpointage.Location = New System.Drawing.Point(859, 160)
        Me.panelpointage.Name = "panelpointage"
        Me.panelpointage.Size = New System.Drawing.Size(229, 123)
        Me.panelpointage.TabIndex = 27
        '
        'Label4
        '
        Me.Label4.AutoSize = True
        Me.Label4.Font = New System.Drawing.Font("Microsoft Sans Serif", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label4.Location = New System.Drawing.Point(6, 65)
        Me.Label4.Name = "Label4"
        Me.Label4.Size = New System.Drawing.Size(109, 29)
        Me.Label4.TabIndex = 24
        Me.Label4.Text = "Pointage"
        '
        'cptpointage
        '
        Me.cptpointage.AutoSize = True
        Me.cptpointage.Font = New System.Drawing.Font("Microsoft Sans Serif", 20.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.cptpointage.Location = New System.Drawing.Point(3, 13)
        Me.cptpointage.Name = "cptpointage"
        Me.cptpointage.Size = New System.Drawing.Size(227, 46)
        Me.cptpointage.TabIndex = 23
        Me.cptpointage.Text = "cptpointage"
        '
        'paneldateheure
        '
        Me.paneldateheure.BackColor = System.Drawing.Color.Transparent
        Me.paneldateheure.Controls.Add(Me.typeuser)
        Me.paneldateheure.Controls.Add(Me.prenomuser)
        Me.paneldateheure.Controls.Add(Me.nomuser)
        Me.paneldateheure.Controls.Add(Me.joursysteme)
        Me.paneldateheure.Controls.Add(Me.heuresysteme)
        Me.paneldateheure.Controls.Add(Me.datesysteme)
        Me.paneldateheure.Location = New System.Drawing.Point(1137, 160)
        Me.paneldateheure.Name = "paneldateheure"
        Me.paneldateheure.Size = New System.Drawing.Size(421, 355)
        Me.paneldateheure.TabIndex = 28
        '
        'typeuser
        '
        Me.typeuser.AutoSize = True
        Me.typeuser.Font = New System.Drawing.Font("Microsoft Sans Serif", 14.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.typeuser.ForeColor = System.Drawing.Color.Black
        Me.typeuser.Location = New System.Drawing.Point(28, 299)
        Me.typeuser.Name = "typeuser"
        Me.typeuser.Size = New System.Drawing.Size(124, 32)
        Me.typeuser.TabIndex = 28
        Me.typeuser.Text = "typeuser"
        '
        'prenomuser
        '
        Me.prenomuser.AutoSize = True
        Me.prenomuser.Font = New System.Drawing.Font("Microsoft Sans Serif", 14.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.prenomuser.ForeColor = System.Drawing.Color.Black
        Me.prenomuser.Location = New System.Drawing.Point(28, 267)
        Me.prenomuser.Name = "prenomuser"
        Me.prenomuser.Size = New System.Drawing.Size(166, 32)
        Me.prenomuser.TabIndex = 27
        Me.prenomuser.Text = "prenomuser"
        '
        'nomuser
        '
        Me.nomuser.AutoSize = True
        Me.nomuser.Font = New System.Drawing.Font("Microsoft Sans Serif", 14.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.nomuser.ForeColor = System.Drawing.Color.Black
        Me.nomuser.Location = New System.Drawing.Point(28, 235)
        Me.nomuser.Name = "nomuser"
        Me.nomuser.Size = New System.Drawing.Size(125, 32)
        Me.nomuser.TabIndex = 26
        Me.nomuser.Text = "nomuser"
        '
        'joursysteme
        '
        Me.joursysteme.AutoSize = True
        Me.joursysteme.BackColor = System.Drawing.Color.Transparent
        Me.joursysteme.Font = New System.Drawing.Font("Microsoft Sans Serif", 24.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.joursysteme.ForeColor = System.Drawing.Color.Black
        Me.joursysteme.Location = New System.Drawing.Point(24, 45)
        Me.joursysteme.Name = "joursysteme"
        Me.joursysteme.Size = New System.Drawing.Size(283, 55)
        Me.joursysteme.TabIndex = 25
        Me.joursysteme.Text = "joursysteme"
        '
        'heuresysteme
        '
        Me.heuresysteme.AutoSize = True
        Me.heuresysteme.Font = New System.Drawing.Font("Microsoft Sans Serif", 20.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.heuresysteme.ForeColor = System.Drawing.Color.Black
        Me.heuresysteme.Location = New System.Drawing.Point(16, 178)
        Me.heuresysteme.Name = "heuresysteme"
        Me.heuresysteme.Size = New System.Drawing.Size(269, 46)
        Me.heuresysteme.TabIndex = 24
        Me.heuresysteme.Text = "heuresysteme"
        '
        'datesysteme
        '
        Me.datesysteme.AutoSize = True
        Me.datesysteme.BackColor = System.Drawing.Color.Transparent
        Me.datesysteme.Font = New System.Drawing.Font("Microsoft Sans Serif", 24.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.datesysteme.ForeColor = System.Drawing.Color.Black
        Me.datesysteme.Location = New System.Drawing.Point(14, 106)
        Me.datesysteme.Name = "datesysteme"
        Me.datesysteme.Size = New System.Drawing.Size(297, 55)
        Me.datesysteme.TabIndex = 23
        Me.datesysteme.Text = "datesysteme"
        '
        'Timer1
        '
        Me.Timer1.Enabled = True
        Me.Timer1.Interval = 1000
        '
        'panelauthentification
        '
        Me.panelauthentification.BackColor = System.Drawing.Color.FromArgb(CType(CType(27, Byte), Integer), CType(CType(57, Byte), Integer), CType(CType(148, Byte), Integer))
        Me.panelauthentification.Controls.Add(Me.Fermer)
        Me.panelauthentification.Controls.Add(Me.seconnecter)
        Me.panelauthentification.Controls.Add(Me.motdepasse)
        Me.panelauthentification.Controls.Add(Me.Label6)
        Me.panelauthentification.Controls.Add(Me.login)
        Me.panelauthentification.Controls.Add(Me.Label5)
        Me.panelauthentification.ForeColor = System.Drawing.Color.White
        Me.panelauthentification.Location = New System.Drawing.Point(702, 338)
        Me.panelauthentification.Name = "panelauthentification"
        Me.panelauthentification.Size = New System.Drawing.Size(358, 280)
        Me.panelauthentification.TabIndex = 29
        '
        'Fermer
        '
        Me.Fermer.ForeColor = System.Drawing.Color.Black
        Me.Fermer.Location = New System.Drawing.Point(190, 212)
        Me.Fermer.Name = "Fermer"
        Me.Fermer.Size = New System.Drawing.Size(134, 48)
        Me.Fermer.TabIndex = 5
        Me.Fermer.Text = "Fermer"
        Me.Fermer.UseVisualStyleBackColor = True
        '
        'seconnecter
        '
        Me.seconnecter.ForeColor = System.Drawing.Color.Black
        Me.seconnecter.Location = New System.Drawing.Point(23, 212)
        Me.seconnecter.Name = "seconnecter"
        Me.seconnecter.Size = New System.Drawing.Size(134, 48)
        Me.seconnecter.TabIndex = 4
        Me.seconnecter.Text = "Se connecter"
        Me.seconnecter.UseVisualStyleBackColor = True
        '
        'motdepasse
        '
        Me.motdepasse.Font = New System.Drawing.Font("Microsoft Sans Serif", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.motdepasse.Location = New System.Drawing.Point(23, 142)
        Me.motdepasse.Name = "motdepasse"
        Me.motdepasse.PasswordChar = Global.Microsoft.VisualBasic.ChrW(42)
        Me.motdepasse.Size = New System.Drawing.Size(301, 35)
        Me.motdepasse.TabIndex = 3
        '
        'Label6
        '
        Me.Label6.AutoSize = True
        Me.Label6.Location = New System.Drawing.Point(19, 115)
        Me.Label6.Name = "Label6"
        Me.Label6.Size = New System.Drawing.Size(105, 20)
        Me.Label6.TabIndex = 2
        Me.Label6.Text = "Mot de passe"
        '
        'login
        '
        Me.login.Font = New System.Drawing.Font("Microsoft Sans Serif", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.login.Location = New System.Drawing.Point(23, 57)
        Me.login.Name = "login"
        Me.login.Size = New System.Drawing.Size(301, 35)
        Me.login.TabIndex = 1
        '
        'Label5
        '
        Me.Label5.AutoSize = True
        Me.Label5.Location = New System.Drawing.Point(19, 26)
        Me.Label5.Name = "Label5"
        Me.Label5.Size = New System.Drawing.Size(48, 20)
        Me.Label5.TabIndex = 0
        Me.Label5.Text = "Login"
        '
        'panelutilisateur
        '
        Me.panelutilisateur.BackColor = System.Drawing.Color.FromArgb(CType(CType(128, Byte), Integer), CType(CType(128, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.panelutilisateur.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle
        Me.panelutilisateur.Controls.Add(Me.Label7)
        Me.panelutilisateur.Controls.Add(Me.cptutilisateur)
        Me.panelutilisateur.Location = New System.Drawing.Point(1116, 160)
        Me.panelutilisateur.Name = "panelutilisateur"
        Me.panelutilisateur.Size = New System.Drawing.Size(229, 123)
        Me.panelutilisateur.TabIndex = 30
        '
        'Label7
        '
        Me.Label7.AutoSize = True
        Me.Label7.Font = New System.Drawing.Font("Microsoft Sans Serif", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label7.Location = New System.Drawing.Point(6, 65)
        Me.Label7.Name = "Label7"
        Me.Label7.Size = New System.Drawing.Size(120, 29)
        Me.Label7.TabIndex = 24
        Me.Label7.Text = "Utilisateur"
        '
        'cptutilisateur
        '
        Me.cptutilisateur.AutoSize = True
        Me.cptutilisateur.Font = New System.Drawing.Font("Microsoft Sans Serif", 20.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.cptutilisateur.Location = New System.Drawing.Point(3, 13)
        Me.cptutilisateur.Name = "cptutilisateur"
        Me.cptutilisateur.Size = New System.Drawing.Size(244, 46)
        Me.cptutilisateur.TabIndex = 23
        Me.cptutilisateur.Text = "cptutilisateur"
        '
        'menu
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(9.0!, 20.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.ClientSize = New System.Drawing.Size(1579, 852)
        Me.Controls.Add(Me.panelutilisateur)
        Me.Controls.Add(Me.panelauthentification)
        Me.Controls.Add(Me.paneldateheure)
        Me.Controls.Add(Me.panelpointage)
        Me.Controls.Add(Me.panelaffectation)
        Me.Controls.Add(Me.panelemploye)
        Me.Controls.Add(Me.panelservice)
        Me.Controls.Add(Me.tnomentreprise)
        Me.Controls.Add(Me.tsigle)
        Me.Controls.Add(Me.ToolStrip1)
        Me.Controls.Add(Me.StatusStrip1)
        Me.Controls.Add(Me.MenuStrip1)
        Me.MainMenuStrip = Me.MenuStrip1
        Me.Name = "menu"
        Me.Text = "menu"
        Me.StatusStrip1.ResumeLayout(False)
        Me.StatusStrip1.PerformLayout()
        Me.MenuStrip1.ResumeLayout(False)
        Me.MenuStrip1.PerformLayout()
        Me.ToolStrip1.ResumeLayout(False)
        Me.ToolStrip1.PerformLayout()
        Me.panelservice.ResumeLayout(False)
        Me.panelservice.PerformLayout()
        Me.panelemploye.ResumeLayout(False)
        Me.panelemploye.PerformLayout()
        Me.panelaffectation.ResumeLayout(False)
        Me.panelaffectation.PerformLayout()
        Me.panelpointage.ResumeLayout(False)
        Me.panelpointage.PerformLayout()
        Me.paneldateheure.ResumeLayout(False)
        Me.paneldateheure.PerformLayout()
        Me.panelauthentification.ResumeLayout(False)
        Me.panelauthentification.PerformLayout()
        Me.panelutilisateur.ResumeLayout(False)
        Me.panelutilisateur.PerformLayout()
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents StatusStrip1 As System.Windows.Forms.StatusStrip
    Friend WithEvents ToolStripStatusLabel1 As System.Windows.Forms.ToolStripStatusLabel
    Friend WithEvents ToolStripStatusLabel2 As System.Windows.Forms.ToolStripStatusLabel
    Friend WithEvents MenuStrip1 As System.Windows.Forms.MenuStrip
    Friend WithEvents AccueilToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents QuitterToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents OrganisationToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents GestionDesServicesToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents GestionDesEmployésToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents AffecttationDeSemployésToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents PointageToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents RapportsToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents ParamètresToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents GestionDesUtilisateursToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents ConfigurationDeLapplicationToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents RapportDePointageToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents RapportDaffectaionToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents ToolStripSeparator1 As System.Windows.Forms.ToolStripSeparator
    Friend WithEvents ToolStripSeparator2 As System.Windows.Forms.ToolStripSeparator
    Friend WithEvents PointageIndividuelToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents PointageAutomatiqueToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents AideToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents ToolStrip1 As System.Windows.Forms.ToolStrip
    Friend WithEvents service As System.Windows.Forms.ToolStripButton
    Friend WithEvents ToolStripSeparator3 As System.Windows.Forms.ToolStripSeparator
    Friend WithEvents employe As System.Windows.Forms.ToolStripButton
    Friend WithEvents ToolStripSeparator4 As System.Windows.Forms.ToolStripSeparator
    Friend WithEvents affecter As System.Windows.Forms.ToolStripButton
    Friend WithEvents ToolStripSeparator5 As System.Windows.Forms.ToolStripSeparator
    Friend WithEvents pointageindividuel As System.Windows.Forms.ToolStripButton
    Friend WithEvents ToolStripSeparator6 As System.Windows.Forms.ToolStripSeparator
    Friend WithEvents pauto As System.Windows.Forms.ToolStripButton
    Friend WithEvents ToolStripSeparator7 As System.Windows.Forms.ToolStripSeparator
    Friend WithEvents ToolStripButton6 As System.Windows.Forms.ToolStripButton
    Friend WithEvents EtatDesServicesToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents ToolStripSeparator8 As System.Windows.Forms.ToolStripSeparator
    Friend WithEvents EtatDesEmployésParServiceToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents tsigle As System.Windows.Forms.Label
    Friend WithEvents tnomentreprise As System.Windows.Forms.Label
    Friend WithEvents panelservice As System.Windows.Forms.Panel
    Friend WithEvents cptservice As System.Windows.Forms.Label
    Friend WithEvents Label1 As System.Windows.Forms.Label
    Friend WithEvents panelemploye As System.Windows.Forms.Panel
    Friend WithEvents Label2 As System.Windows.Forms.Label
    Friend WithEvents cptemploye As System.Windows.Forms.Label
    Friend WithEvents panelaffectation As System.Windows.Forms.Panel
    Friend WithEvents Label3 As System.Windows.Forms.Label
    Friend WithEvents cptaffectation As System.Windows.Forms.Label
    Friend WithEvents panelpointage As System.Windows.Forms.Panel
    Friend WithEvents Label4 As System.Windows.Forms.Label
    Friend WithEvents cptpointage As System.Windows.Forms.Label
    Friend WithEvents paneldateheure As System.Windows.Forms.Panel
    Friend WithEvents heuresysteme As System.Windows.Forms.Label
    Friend WithEvents datesysteme As System.Windows.Forms.Label
    Friend WithEvents Timer1 As System.Windows.Forms.Timer
    Friend WithEvents joursysteme As System.Windows.Forms.Label
    Friend WithEvents LesPointagesDunEmployéToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents LesPointagesDunServiceToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents panelauthentification As System.Windows.Forms.Panel
    Friend WithEvents seconnecter As System.Windows.Forms.Button
    Friend WithEvents motdepasse As System.Windows.Forms.TextBox
    Friend WithEvents Label6 As System.Windows.Forms.Label
    Friend WithEvents login As System.Windows.Forms.TextBox
    Friend WithEvents Label5 As System.Windows.Forms.Label
    Friend WithEvents Fermer As System.Windows.Forms.Button
    Friend WithEvents prenomuser As System.Windows.Forms.Label
    Friend WithEvents nomuser As System.Windows.Forms.Label
    Friend WithEvents typeuser As System.Windows.Forms.Label
    Friend WithEvents DéconnecterToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents ToolStripSeparator9 As System.Windows.Forms.ToolStripSeparator
    Friend WithEvents ToolStripSeparator10 As System.Windows.Forms.ToolStripSeparator
    Friend WithEvents ToolStripSeparator11 As System.Windows.Forms.ToolStripSeparator
    Friend WithEvents barredoutils As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents panelutilisateur As System.Windows.Forms.Panel
    Friend WithEvents Label7 As System.Windows.Forms.Label
    Friend WithEvents cptutilisateur As System.Windows.Forms.Label
    Friend WithEvents AideEnLigneToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents TutorielsVidéoToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents FAQToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents SupportTechniqueToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents MisesÀJourEtNouveautésToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents SignalerUnProblèmeToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents PolitiqueDeConfidentialitéToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents ConditionsDutilisationToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents ToolStripSeparator12 As System.Windows.Forms.ToolStripSeparator
    Friend WithEvents AProposToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents ToolStripSeparator13 As System.Windows.Forms.ToolStripSeparator
    Friend WithEvents ToolStripSeparator14 As System.Windows.Forms.ToolStripSeparator
End Class
