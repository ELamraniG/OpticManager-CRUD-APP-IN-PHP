<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class Employe_form
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
        Dim resources As System.ComponentModel.ComponentResourceManager = New System.ComponentModel.ComponentResourceManager(GetType(Employe_form))
        Me.ligne_modifie = New System.Windows.Forms.Label()
        Me.type_operation = New System.Windows.Forms.Label()
        Me.ImageList1 = New System.Windows.Forms.ImageList(Me.components)
        Me.GroupBox1 = New System.Windows.Forms.GroupBox()
        Me.ddn = New System.Windows.Forms.DateTimePicker()
        Me.Label8 = New System.Windows.Forms.Label()
        Me.email = New System.Windows.Forms.TextBox()
        Me.Label7 = New System.Windows.Forms.Label()
        Me.tel = New System.Windows.Forms.TextBox()
        Me.Label6 = New System.Windows.Forms.Label()
        Me.adresse = New System.Windows.Forms.TextBox()
        Me.Label5 = New System.Windows.Forms.Label()
        Me.ncin = New System.Windows.Forms.TextBox()
        Me.Label4 = New System.Windows.Forms.Label()
        Me.prenom = New System.Windows.Forms.TextBox()
        Me.Label3 = New System.Windows.Forms.Label()
        Me.ancien_idemploye = New System.Windows.Forms.TextBox()
        Me.nomemploye = New System.Windows.Forms.TextBox()
        Me.Label2 = New System.Windows.Forms.Label()
        Me.Idemploye = New System.Windows.Forms.TextBox()
        Me.Label1 = New System.Windows.Forms.Label()
        Me.GroupBox2 = New System.Windows.Forms.GroupBox()
        Me.ddr = New System.Windows.Forms.DateTimePicker()
        Me.salairenet = New System.Windows.Forms.MaskedTextBox()
        Me.mdp_confirm = New System.Windows.Forms.TextBox()
        Me.Label10 = New System.Windows.Forms.Label()
        Me.Label9 = New System.Windows.Forms.Label()
        Me.specialite = New System.Windows.Forms.TextBox()
        Me.Label13 = New System.Windows.Forms.Label()
        Me.mdp = New System.Windows.Forms.TextBox()
        Me.Label14 = New System.Windows.Forms.Label()
        Me.Label15 = New System.Windows.Forms.Label()
        Me.fonction = New System.Windows.Forms.TextBox()
        Me.Label16 = New System.Windows.Forms.Label()
        Me.Ouvrir = New System.Windows.Forms.Button()
        Me.PictureBox1 = New System.Windows.Forms.PictureBox()
        Me.Save = New System.Windows.Forms.Button()
        Me.Label11 = New System.Windows.Forms.Label()
        Me.nom_photo = New System.Windows.Forms.Label()
        Me.anc_nom = New System.Windows.Forms.Label()
        Me.GroupBox1.SuspendLayout()
        Me.GroupBox2.SuspendLayout()
        CType(Me.PictureBox1, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.SuspendLayout()
        '
        'ligne_modifie
        '
        Me.ligne_modifie.AutoSize = True
        Me.ligne_modifie.Location = New System.Drawing.Point(133, 3)
        Me.ligne_modifie.Name = "ligne_modifie"
        Me.ligne_modifie.Size = New System.Drawing.Size(102, 20)
        Me.ligne_modifie.TabIndex = 15
        Me.ligne_modifie.Text = "ligne_modifie"
        '
        'type_operation
        '
        Me.type_operation.AutoSize = True
        Me.type_operation.Location = New System.Drawing.Point(12, 3)
        Me.type_operation.Name = "type_operation"
        Me.type_operation.Size = New System.Drawing.Size(115, 20)
        Me.type_operation.TabIndex = 14
        Me.type_operation.Text = "type_operation"
        '
        'ImageList1
        '
        Me.ImageList1.ImageStream = CType(resources.GetObject("ImageList1.ImageStream"), System.Windows.Forms.ImageListStreamer)
        Me.ImageList1.TransparentColor = System.Drawing.Color.Transparent
        Me.ImageList1.Images.SetKeyName(0, "actualiser.png")
        Me.ImageList1.Images.SetKeyName(1, "ajouter.png")
        Me.ImageList1.Images.SetKeyName(2, "imprimer.png")
        Me.ImageList1.Images.SetKeyName(3, "rechercher.png")
        Me.ImageList1.Images.SetKeyName(4, "save.png")
        Me.ImageList1.Images.SetKeyName(5, "supprimer.png")
        Me.ImageList1.Images.SetKeyName(6, "ouvrir.png")
        '
        'GroupBox1
        '
        Me.GroupBox1.Controls.Add(Me.ddn)
        Me.GroupBox1.Controls.Add(Me.Label8)
        Me.GroupBox1.Controls.Add(Me.email)
        Me.GroupBox1.Controls.Add(Me.Label7)
        Me.GroupBox1.Controls.Add(Me.tel)
        Me.GroupBox1.Controls.Add(Me.Label6)
        Me.GroupBox1.Controls.Add(Me.adresse)
        Me.GroupBox1.Controls.Add(Me.Label5)
        Me.GroupBox1.Controls.Add(Me.ncin)
        Me.GroupBox1.Controls.Add(Me.Label4)
        Me.GroupBox1.Controls.Add(Me.prenom)
        Me.GroupBox1.Controls.Add(Me.Label3)
        Me.GroupBox1.Controls.Add(Me.ancien_idemploye)
        Me.GroupBox1.Controls.Add(Me.nomemploye)
        Me.GroupBox1.Controls.Add(Me.Label2)
        Me.GroupBox1.Controls.Add(Me.Idemploye)
        Me.GroupBox1.Controls.Add(Me.Label1)
        Me.GroupBox1.Location = New System.Drawing.Point(16, 26)
        Me.GroupBox1.Name = "GroupBox1"
        Me.GroupBox1.Size = New System.Drawing.Size(1077, 326)
        Me.GroupBox1.TabIndex = 18
        Me.GroupBox1.TabStop = False
        Me.GroupBox1.Text = "Identité "
        '
        'ddn
        '
        Me.ddn.Format = System.Windows.Forms.DateTimePickerFormat.[Short]
        Me.ddn.Location = New System.Drawing.Point(829, 68)
        Me.ddn.Name = "ddn"
        Me.ddn.Size = New System.Drawing.Size(222, 26)
        Me.ddn.TabIndex = 7
        '
        'Label8
        '
        Me.Label8.AutoSize = True
        Me.Label8.Location = New System.Drawing.Point(830, 43)
        Me.Label8.Name = "Label8"
        Me.Label8.Size = New System.Drawing.Size(142, 20)
        Me.Label8.TabIndex = 45
        Me.Label8.Text = "Date de naissance"
        '
        'email
        '
        Me.email.Location = New System.Drawing.Point(429, 271)
        Me.email.Name = "email"
        Me.email.Size = New System.Drawing.Size(373, 26)
        Me.email.TabIndex = 6
        '
        'Label7
        '
        Me.Label7.AutoSize = True
        Me.Label7.Location = New System.Drawing.Point(425, 248)
        Me.Label7.Name = "Label7"
        Me.Label7.Size = New System.Drawing.Size(53, 20)
        Me.Label7.TabIndex = 43
        Me.Label7.Text = "E-mail"
        '
        'tel
        '
        Me.tel.Location = New System.Drawing.Point(429, 196)
        Me.tel.Name = "tel"
        Me.tel.Size = New System.Drawing.Size(373, 26)
        Me.tel.TabIndex = 5
        '
        'Label6
        '
        Me.Label6.AutoSize = True
        Me.Label6.Location = New System.Drawing.Point(425, 173)
        Me.Label6.Name = "Label6"
        Me.Label6.Size = New System.Drawing.Size(30, 20)
        Me.Label6.TabIndex = 41
        Me.Label6.Text = "Tél"
        '
        'adresse
        '
        Me.adresse.Location = New System.Drawing.Point(18, 196)
        Me.adresse.Multiline = True
        Me.adresse.Name = "adresse"
        Me.adresse.Size = New System.Drawing.Size(373, 101)
        Me.adresse.TabIndex = 4
        '
        'Label5
        '
        Me.Label5.AutoSize = True
        Me.Label5.Location = New System.Drawing.Point(14, 173)
        Me.Label5.Name = "Label5"
        Me.Label5.Size = New System.Drawing.Size(68, 20)
        Me.Label5.TabIndex = 39
        Me.Label5.Text = "Adresse"
        '
        'ncin
        '
        Me.ncin.Location = New System.Drawing.Point(429, 66)
        Me.ncin.Name = "ncin"
        Me.ncin.Size = New System.Drawing.Size(217, 26)
        Me.ncin.TabIndex = 1
        '
        'Label4
        '
        Me.Label4.AutoSize = True
        Me.Label4.Location = New System.Drawing.Point(425, 43)
        Me.Label4.Name = "Label4"
        Me.Label4.Size = New System.Drawing.Size(51, 20)
        Me.Label4.TabIndex = 37
        Me.Label4.Text = "N CIN"
        '
        'prenom
        '
        Me.prenom.Location = New System.Drawing.Point(429, 129)
        Me.prenom.Name = "prenom"
        Me.prenom.Size = New System.Drawing.Size(373, 26)
        Me.prenom.TabIndex = 3
        '
        'Label3
        '
        Me.Label3.AutoSize = True
        Me.Label3.Location = New System.Drawing.Point(425, 106)
        Me.Label3.Name = "Label3"
        Me.Label3.Size = New System.Drawing.Size(64, 20)
        Me.Label3.TabIndex = 35
        Me.Label3.Text = "Prénom"
        '
        'ancien_idemploye
        '
        Me.ancien_idemploye.Location = New System.Drawing.Point(241, 53)
        Me.ancien_idemploye.Name = "ancien_idemploye"
        Me.ancien_idemploye.Size = New System.Drawing.Size(50, 26)
        Me.ancien_idemploye.TabIndex = 34
        Me.ancien_idemploye.Visible = False
        '
        'nomemploye
        '
        Me.nomemploye.Location = New System.Drawing.Point(18, 129)
        Me.nomemploye.Name = "nomemploye"
        Me.nomemploye.Size = New System.Drawing.Size(373, 26)
        Me.nomemploye.TabIndex = 2
        '
        'Label2
        '
        Me.Label2.AutoSize = True
        Me.Label2.Location = New System.Drawing.Point(14, 106)
        Me.Label2.Name = "Label2"
        Me.Label2.Size = New System.Drawing.Size(42, 20)
        Me.Label2.TabIndex = 32
        Me.Label2.Text = "Nom"
        '
        'Idemploye
        '
        Me.Idemploye.Location = New System.Drawing.Point(18, 66)
        Me.Idemploye.Name = "Idemploye"
        Me.Idemploye.Size = New System.Drawing.Size(217, 26)
        Me.Idemploye.TabIndex = 0
        '
        'Label1
        '
        Me.Label1.AutoSize = True
        Me.Label1.Location = New System.Drawing.Point(14, 43)
        Me.Label1.Name = "Label1"
        Me.Label1.Size = New System.Drawing.Size(91, 20)
        Me.Label1.TabIndex = 30
        Me.Label1.Text = "ID Employé"
        '
        'GroupBox2
        '
        Me.GroupBox2.Controls.Add(Me.ddr)
        Me.GroupBox2.Controls.Add(Me.salairenet)
        Me.GroupBox2.Controls.Add(Me.mdp_confirm)
        Me.GroupBox2.Controls.Add(Me.Label10)
        Me.GroupBox2.Controls.Add(Me.Label9)
        Me.GroupBox2.Controls.Add(Me.specialite)
        Me.GroupBox2.Controls.Add(Me.Label13)
        Me.GroupBox2.Controls.Add(Me.mdp)
        Me.GroupBox2.Controls.Add(Me.Label14)
        Me.GroupBox2.Controls.Add(Me.Label15)
        Me.GroupBox2.Controls.Add(Me.fonction)
        Me.GroupBox2.Controls.Add(Me.Label16)
        Me.GroupBox2.Location = New System.Drawing.Point(16, 369)
        Me.GroupBox2.Name = "GroupBox2"
        Me.GroupBox2.Size = New System.Drawing.Size(1077, 246)
        Me.GroupBox2.TabIndex = 19
        Me.GroupBox2.TabStop = False
        Me.GroupBox2.Text = "Fonction"
        '
        'ddr
        '
        Me.ddr.Format = System.Windows.Forms.DateTimePickerFormat.[Short]
        Me.ddr.Location = New System.Drawing.Point(829, 53)
        Me.ddr.Name = "ddr"
        Me.ddr.Size = New System.Drawing.Size(222, 26)
        Me.ddr.TabIndex = 11
        '
        'salairenet
        '
        Me.salairenet.Location = New System.Drawing.Point(18, 129)
        Me.salairenet.Mask = "99999"
        Me.salairenet.Name = "salairenet"
        Me.salairenet.Size = New System.Drawing.Size(217, 26)
        Me.salairenet.TabIndex = 10
        Me.salairenet.Text = "0"
        Me.salairenet.ValidatingType = GetType(Integer)
        '
        'mdp_confirm
        '
        Me.mdp_confirm.Location = New System.Drawing.Point(429, 197)
        Me.mdp_confirm.Name = "mdp_confirm"
        Me.mdp_confirm.PasswordChar = Global.Microsoft.VisualBasic.ChrW(42)
        Me.mdp_confirm.Size = New System.Drawing.Size(373, 26)
        Me.mdp_confirm.TabIndex = 13
        '
        'Label10
        '
        Me.Label10.AutoSize = True
        Me.Label10.Location = New System.Drawing.Point(425, 174)
        Me.Label10.Name = "Label10"
        Me.Label10.Size = New System.Drawing.Size(194, 20)
        Me.Label10.TabIndex = 49
        Me.Label10.Text = "Confirmer le mot de passe"
        '
        'Label9
        '
        Me.Label9.AutoSize = True
        Me.Label9.Location = New System.Drawing.Point(830, 30)
        Me.Label9.Name = "Label9"
        Me.Label9.Size = New System.Drawing.Size(156, 20)
        Me.Label9.TabIndex = 45
        Me.Label9.Text = "Date de recrutement"
        '
        'specialite
        '
        Me.specialite.Location = New System.Drawing.Point(429, 53)
        Me.specialite.Name = "specialite"
        Me.specialite.Size = New System.Drawing.Size(373, 26)
        Me.specialite.TabIndex = 9
        '
        'Label13
        '
        Me.Label13.AutoSize = True
        Me.Label13.Location = New System.Drawing.Point(425, 30)
        Me.Label13.Name = "Label13"
        Me.Label13.Size = New System.Drawing.Size(78, 20)
        Me.Label13.TabIndex = 37
        Me.Label13.Text = "Spécialité"
        '
        'mdp
        '
        Me.mdp.Location = New System.Drawing.Point(429, 129)
        Me.mdp.Name = "mdp"
        Me.mdp.PasswordChar = Global.Microsoft.VisualBasic.ChrW(42)
        Me.mdp.Size = New System.Drawing.Size(373, 26)
        Me.mdp.TabIndex = 12
        '
        'Label14
        '
        Me.Label14.AutoSize = True
        Me.Label14.Location = New System.Drawing.Point(425, 106)
        Me.Label14.Name = "Label14"
        Me.Label14.Size = New System.Drawing.Size(105, 20)
        Me.Label14.TabIndex = 35
        Me.Label14.Text = "Mot de passe"
        '
        'Label15
        '
        Me.Label15.AutoSize = True
        Me.Label15.Location = New System.Drawing.Point(14, 106)
        Me.Label15.Name = "Label15"
        Me.Label15.Size = New System.Drawing.Size(87, 20)
        Me.Label15.TabIndex = 32
        Me.Label15.Text = "Salaire Net"
        '
        'fonction
        '
        Me.fonction.Location = New System.Drawing.Point(18, 53)
        Me.fonction.Name = "fonction"
        Me.fonction.Size = New System.Drawing.Size(373, 26)
        Me.fonction.TabIndex = 8
        '
        'Label16
        '
        Me.Label16.AutoSize = True
        Me.Label16.Location = New System.Drawing.Point(14, 30)
        Me.Label16.Name = "Label16"
        Me.Label16.Size = New System.Drawing.Size(71, 20)
        Me.Label16.TabIndex = 30
        Me.Label16.Text = "Fonction"
        '
        'Ouvrir
        '
        Me.Ouvrir.BackColor = System.Drawing.Color.White
        Me.Ouvrir.FlatAppearance.BorderSize = 0
        Me.Ouvrir.FlatAppearance.MouseOverBackColor = System.Drawing.Color.Transparent
        Me.Ouvrir.FlatStyle = System.Windows.Forms.FlatStyle.Flat
        Me.Ouvrir.ImageIndex = 6
        Me.Ouvrir.ImageList = Me.ImageList1
        Me.Ouvrir.Location = New System.Drawing.Point(1213, 274)
        Me.Ouvrir.Name = "Ouvrir"
        Me.Ouvrir.Size = New System.Drawing.Size(57, 46)
        Me.Ouvrir.TabIndex = 14
        Me.Ouvrir.UseVisualStyleBackColor = False
        '
        'PictureBox1
        '
        Me.PictureBox1.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle
        Me.PictureBox1.Image = Global.TP14.My.Resources.Resources.employee
        Me.PictureBox1.Location = New System.Drawing.Point(1112, 38)
        Me.PictureBox1.Name = "PictureBox1"
        Me.PictureBox1.Size = New System.Drawing.Size(237, 226)
        Me.PictureBox1.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.PictureBox1.TabIndex = 16
        Me.PictureBox1.TabStop = False
        '
        'Save
        '
        Me.Save.BackColor = System.Drawing.Color.White
        Me.Save.FlatAppearance.BorderSize = 0
        Me.Save.FlatAppearance.MouseOverBackColor = System.Drawing.Color.Transparent
        Me.Save.FlatStyle = System.Windows.Forms.FlatStyle.Flat
        Me.Save.ImageIndex = 4
        Me.Save.ImageList = Me.ImageList1
        Me.Save.Location = New System.Drawing.Point(16, 632)
        Me.Save.Name = "Save"
        Me.Save.Size = New System.Drawing.Size(56, 46)
        Me.Save.TabIndex = 15
        Me.Save.TextAlign = System.Drawing.ContentAlignment.MiddleRight
        Me.Save.UseVisualStyleBackColor = False
        '
        'Label11
        '
        Me.Label11.AutoSize = True
        Me.Label11.Location = New System.Drawing.Point(602, 339)
        Me.Label11.Name = "Label11"
        Me.Label11.Size = New System.Drawing.Size(194, 20)
        Me.Label11.TabIndex = 50
        Me.Label11.Text = "Confirmer le mot de passe"
        '
        'nom_photo
        '
        Me.nom_photo.AutoSize = True
        Me.nom_photo.Location = New System.Drawing.Point(1108, 9)
        Me.nom_photo.Name = "nom_photo"
        Me.nom_photo.Size = New System.Drawing.Size(108, 20)
        Me.nom_photo.TabIndex = 51
        Me.nom_photo.Text = "employee.png"
        '
        'anc_nom
        '
        Me.anc_nom.AutoSize = True
        Me.anc_nom.Location = New System.Drawing.Point(253, 9)
        Me.anc_nom.Name = "anc_nom"
        Me.anc_nom.Size = New System.Drawing.Size(0, 20)
        Me.anc_nom.TabIndex = 52
        '
        'Employe_form
        '
        Me.AcceptButton = Me.Save
        Me.AutoScaleDimensions = New System.Drawing.SizeF(9.0!, 20.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.ClientSize = New System.Drawing.Size(1399, 699)
        Me.Controls.Add(Me.anc_nom)
        Me.Controls.Add(Me.nom_photo)
        Me.Controls.Add(Me.Label11)
        Me.Controls.Add(Me.GroupBox2)
        Me.Controls.Add(Me.GroupBox1)
        Me.Controls.Add(Me.Ouvrir)
        Me.Controls.Add(Me.PictureBox1)
        Me.Controls.Add(Me.ligne_modifie)
        Me.Controls.Add(Me.type_operation)
        Me.Controls.Add(Me.Save)
        Me.Name = "Employe_form"
        Me.Text = "Employe_form"
        Me.GroupBox1.ResumeLayout(False)
        Me.GroupBox1.PerformLayout()
        Me.GroupBox2.ResumeLayout(False)
        Me.GroupBox2.PerformLayout()
        CType(Me.PictureBox1, System.ComponentModel.ISupportInitialize).EndInit()
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents ligne_modifie As System.Windows.Forms.Label
    Friend WithEvents type_operation As System.Windows.Forms.Label
    Friend WithEvents Save As System.Windows.Forms.Button
    Friend WithEvents PictureBox1 As System.Windows.Forms.PictureBox
    Friend WithEvents ImageList1 As System.Windows.Forms.ImageList
    Friend WithEvents Ouvrir As System.Windows.Forms.Button
    Friend WithEvents GroupBox1 As System.Windows.Forms.GroupBox
    Friend WithEvents Label8 As System.Windows.Forms.Label
    Friend WithEvents email As System.Windows.Forms.TextBox
    Friend WithEvents Label7 As System.Windows.Forms.Label
    Friend WithEvents tel As System.Windows.Forms.TextBox
    Friend WithEvents Label6 As System.Windows.Forms.Label
    Friend WithEvents adresse As System.Windows.Forms.TextBox
    Friend WithEvents Label5 As System.Windows.Forms.Label
    Friend WithEvents ncin As System.Windows.Forms.TextBox
    Friend WithEvents Label4 As System.Windows.Forms.Label
    Friend WithEvents prenom As System.Windows.Forms.TextBox
    Friend WithEvents Label3 As System.Windows.Forms.Label
    Friend WithEvents ancien_idemploye As System.Windows.Forms.TextBox
    Friend WithEvents nomemploye As System.Windows.Forms.TextBox
    Friend WithEvents Label2 As System.Windows.Forms.Label
    Friend WithEvents Idemploye As System.Windows.Forms.TextBox
    Friend WithEvents Label1 As System.Windows.Forms.Label
    Friend WithEvents GroupBox2 As System.Windows.Forms.GroupBox
    Friend WithEvents Label9 As System.Windows.Forms.Label
    Friend WithEvents specialite As System.Windows.Forms.TextBox
    Friend WithEvents Label13 As System.Windows.Forms.Label
    Friend WithEvents mdp As System.Windows.Forms.TextBox
    Friend WithEvents Label14 As System.Windows.Forms.Label
    Friend WithEvents Label15 As System.Windows.Forms.Label
    Friend WithEvents fonction As System.Windows.Forms.TextBox
    Friend WithEvents Label16 As System.Windows.Forms.Label
    Friend WithEvents ddn As System.Windows.Forms.DateTimePicker
    Friend WithEvents mdp_confirm As System.Windows.Forms.TextBox
    Friend WithEvents Label10 As System.Windows.Forms.Label
    Friend WithEvents Label11 As System.Windows.Forms.Label
    Friend WithEvents nom_photo As System.Windows.Forms.Label
    Friend WithEvents anc_nom As System.Windows.Forms.Label
    Friend WithEvents salairenet As System.Windows.Forms.MaskedTextBox
    Friend WithEvents ddr As System.Windows.Forms.DateTimePicker
End Class
