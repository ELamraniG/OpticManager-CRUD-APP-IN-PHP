<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class affecter_form
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
        Dim resources As System.ComponentModel.ComponentResourceManager = New System.ComponentModel.ComponentResourceManager(GetType(affecter_form))
        Me.ligne_modifie = New System.Windows.Forms.Label()
        Me.ImageList1 = New System.Windows.Forms.ImageList(Me.components)
        Me.type_operation = New System.Windows.Forms.Label()
        Me.ancien_idservice = New System.Windows.Forms.TextBox()
        Me.Label2 = New System.Windows.Forms.Label()
        Me.Label1 = New System.Windows.Forms.Label()
        Me.Save = New System.Windows.Forms.Button()
        Me.idservice = New System.Windows.Forms.ComboBox()
        Me.idemploye = New System.Windows.Forms.ComboBox()
        Me.Label3 = New System.Windows.Forms.Label()
        Me.datedebut = New System.Windows.Forms.DateTimePicker()
        Me.datefin = New System.Windows.Forms.DateTimePicker()
        Me.CheckBox1 = New System.Windows.Forms.CheckBox()
        Me.ancien_ide = New System.Windows.Forms.TextBox()
        Me.datefin_vide = New System.Windows.Forms.TextBox()
        Me.SuspendLayout()
        '
        'ligne_modifie
        '
        Me.ligne_modifie.AutoSize = True
        Me.ligne_modifie.Location = New System.Drawing.Point(271, 3)
        Me.ligne_modifie.Name = "ligne_modifie"
        Me.ligne_modifie.Size = New System.Drawing.Size(102, 20)
        Me.ligne_modifie.TabIndex = 15
        Me.ligne_modifie.Text = "ligne_modifie"
        Me.ligne_modifie.Visible = False
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
        '
        'type_operation
        '
        Me.type_operation.AutoSize = True
        Me.type_operation.Location = New System.Drawing.Point(379, 3)
        Me.type_operation.Name = "type_operation"
        Me.type_operation.Size = New System.Drawing.Size(115, 20)
        Me.type_operation.TabIndex = 14
        Me.type_operation.Text = "type_operation"
        Me.type_operation.Visible = False
        '
        'ancien_idservice
        '
        Me.ancien_idservice.Location = New System.Drawing.Point(500, 3)
        Me.ancien_idservice.Name = "ancien_idservice"
        Me.ancien_idservice.Size = New System.Drawing.Size(217, 26)
        Me.ancien_idservice.TabIndex = 13
        Me.ancien_idservice.Visible = False
        '
        'Label2
        '
        Me.Label2.AutoSize = True
        Me.Label2.Location = New System.Drawing.Point(26, 103)
        Me.Label2.Name = "Label2"
        Me.Label2.Size = New System.Drawing.Size(70, 20)
        Me.Label2.TabIndex = 10
        Me.Label2.Text = "Employé"
        '
        'Label1
        '
        Me.Label1.AutoSize = True
        Me.Label1.Location = New System.Drawing.Point(26, 28)
        Me.Label1.Name = "Label1"
        Me.Label1.Size = New System.Drawing.Size(61, 20)
        Me.Label1.TabIndex = 8
        Me.Label1.Text = "Service"
        '
        'Save
        '
        Me.Save.FlatAppearance.BorderSize = 0
        Me.Save.FlatAppearance.MouseOverBackColor = System.Drawing.Color.FromArgb(CType(CType(128, Byte), Integer), CType(CType(255, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.Save.FlatStyle = System.Windows.Forms.FlatStyle.Flat
        Me.Save.ImageIndex = 4
        Me.Save.ImageList = Me.ImageList1
        Me.Save.Location = New System.Drawing.Point(30, 335)
        Me.Save.Name = "Save"
        Me.Save.Size = New System.Drawing.Size(57, 46)
        Me.Save.TabIndex = 12
        Me.Save.UseVisualStyleBackColor = True
        '
        'idservice
        '
        Me.idservice.FormattingEnabled = True
        Me.idservice.Location = New System.Drawing.Point(30, 51)
        Me.idservice.Name = "idservice"
        Me.idservice.Size = New System.Drawing.Size(343, 28)
        Me.idservice.TabIndex = 16
        '
        'idemploye
        '
        Me.idemploye.FormattingEnabled = True
        Me.idemploye.Location = New System.Drawing.Point(30, 126)
        Me.idemploye.Name = "idemploye"
        Me.idemploye.Size = New System.Drawing.Size(560, 28)
        Me.idemploye.TabIndex = 17
        '
        'Label3
        '
        Me.Label3.AutoSize = True
        Me.Label3.Location = New System.Drawing.Point(26, 179)
        Me.Label3.Name = "Label3"
        Me.Label3.Size = New System.Drawing.Size(89, 20)
        Me.Label3.TabIndex = 18
        Me.Label3.Text = "Date début"
        '
        'datedebut
        '
        Me.datedebut.Format = System.Windows.Forms.DateTimePickerFormat.[Short]
        Me.datedebut.Location = New System.Drawing.Point(30, 202)
        Me.datedebut.Name = "datedebut"
        Me.datedebut.Size = New System.Drawing.Size(158, 26)
        Me.datedebut.TabIndex = 20
        '
        'datefin
        '
        Me.datefin.Format = System.Windows.Forms.DateTimePickerFormat.[Short]
        Me.datefin.Location = New System.Drawing.Point(30, 283)
        Me.datefin.Name = "datefin"
        Me.datefin.Size = New System.Drawing.Size(158, 26)
        Me.datefin.TabIndex = 21
        Me.datefin.Visible = False
        '
        'CheckBox1
        '
        Me.CheckBox1.AutoSize = True
        Me.CheckBox1.Location = New System.Drawing.Point(30, 253)
        Me.CheckBox1.Name = "CheckBox1"
        Me.CheckBox1.Size = New System.Drawing.Size(91, 24)
        Me.CheckBox1.TabIndex = 22
        Me.CheckBox1.Text = "Date fin"
        Me.CheckBox1.UseVisualStyleBackColor = True
        '
        'ancien_ide
        '
        Me.ancien_ide.Location = New System.Drawing.Point(468, 35)
        Me.ancien_ide.Name = "ancien_ide"
        Me.ancien_ide.Size = New System.Drawing.Size(217, 26)
        Me.ancien_ide.TabIndex = 23
        Me.ancien_ide.Visible = False
        '
        'datefin_vide
        '
        Me.datefin_vide.Location = New System.Drawing.Point(451, 67)
        Me.datefin_vide.Name = "datefin_vide"
        Me.datefin_vide.Size = New System.Drawing.Size(217, 26)
        Me.datefin_vide.TabIndex = 24
        Me.datefin_vide.Visible = False
        '
        'affecter_form
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(9.0!, 20.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.ClientSize = New System.Drawing.Size(629, 404)
        Me.Controls.Add(Me.datefin_vide)
        Me.Controls.Add(Me.ancien_ide)
        Me.Controls.Add(Me.CheckBox1)
        Me.Controls.Add(Me.datefin)
        Me.Controls.Add(Me.datedebut)
        Me.Controls.Add(Me.Label3)
        Me.Controls.Add(Me.idemploye)
        Me.Controls.Add(Me.idservice)
        Me.Controls.Add(Me.ligne_modifie)
        Me.Controls.Add(Me.type_operation)
        Me.Controls.Add(Me.ancien_idservice)
        Me.Controls.Add(Me.Save)
        Me.Controls.Add(Me.Label2)
        Me.Controls.Add(Me.Label1)
        Me.Name = "affecter_form"
        Me.Text = "affecter_form"
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents ligne_modifie As System.Windows.Forms.Label
    Friend WithEvents ImageList1 As System.Windows.Forms.ImageList
    Friend WithEvents type_operation As System.Windows.Forms.Label
    Friend WithEvents ancien_idservice As System.Windows.Forms.TextBox
    Friend WithEvents Save As System.Windows.Forms.Button
    Friend WithEvents Label2 As System.Windows.Forms.Label
    Friend WithEvents Label1 As System.Windows.Forms.Label
    Friend WithEvents idservice As System.Windows.Forms.ComboBox
    Friend WithEvents idemploye As System.Windows.Forms.ComboBox
    Friend WithEvents Label3 As System.Windows.Forms.Label
    Friend WithEvents datedebut As System.Windows.Forms.DateTimePicker
    Friend WithEvents datefin As System.Windows.Forms.DateTimePicker
    Friend WithEvents CheckBox1 As System.Windows.Forms.CheckBox
    Friend WithEvents ancien_ide As System.Windows.Forms.TextBox
    Friend WithEvents datefin_vide As System.Windows.Forms.TextBox
End Class
