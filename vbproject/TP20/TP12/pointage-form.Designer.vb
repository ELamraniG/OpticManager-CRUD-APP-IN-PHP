<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class pointage_form
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
        Dim resources As System.ComponentModel.ComponentResourceManager = New System.ComponentModel.ComponentResourceManager(GetType(pointage_form))
        Me.datepointage = New System.Windows.Forms.DateTimePicker()
        Me.Label3 = New System.Windows.Forms.Label()
        Me.idemploye = New System.Windows.Forms.ComboBox()
        Me.Save = New System.Windows.Forms.Button()
        Me.Label1 = New System.Windows.Forms.Label()
        Me.Label2 = New System.Windows.Forms.Label()
        Me.Label4 = New System.Windows.Forms.Label()
        Me.Label5 = New System.Windows.Forms.Label()
        Me.Label6 = New System.Windows.Forms.Label()
        Me.heureentree = New System.Windows.Forms.DateTimePicker()
        Me.heuresortie = New System.Windows.Forms.DateTimePicker()
        Me.typepointage = New System.Windows.Forms.ComboBox()
        Me.notes = New System.Windows.Forms.TextBox()
        Me.ImageList1 = New System.Windows.Forms.ImageList(Me.components)
        Me.Button1 = New System.Windows.Forms.Button()
        Me.ligne_modifie = New System.Windows.Forms.Label()
        Me.type_operation = New System.Windows.Forms.Label()
        Me.ancien_idpointage = New System.Windows.Forms.TextBox()
        Me.SuspendLayout()
        '
        'datepointage
        '
        Me.datepointage.Font = New System.Drawing.Font("Microsoft Sans Serif", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.datepointage.Format = System.Windows.Forms.DateTimePickerFormat.[Short]
        Me.datepointage.Location = New System.Drawing.Point(30, 118)
        Me.datepointage.Name = "datepointage"
        Me.datepointage.Size = New System.Drawing.Size(158, 35)
        Me.datepointage.TabIndex = 29
        '
        'Label3
        '
        Me.Label3.AutoSize = True
        Me.Label3.Location = New System.Drawing.Point(26, 95)
        Me.Label3.Name = "Label3"
        Me.Label3.Size = New System.Drawing.Size(110, 20)
        Me.Label3.TabIndex = 28
        Me.Label3.Text = "Date pointage"
        '
        'idemploye
        '
        Me.idemploye.Font = New System.Drawing.Font("Microsoft Sans Serif", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.idemploye.FormattingEnabled = True
        Me.idemploye.Location = New System.Drawing.Point(30, 48)
        Me.idemploye.Name = "idemploye"
        Me.idemploye.Size = New System.Drawing.Size(360, 37)
        Me.idemploye.TabIndex = 26
        '
        'Save
        '
        Me.Save.FlatAppearance.BorderSize = 0
        Me.Save.FlatAppearance.MouseOverBackColor = System.Drawing.Color.FromArgb(CType(CType(128, Byte), Integer), CType(CType(255, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.Save.FlatStyle = System.Windows.Forms.FlatStyle.Flat
        Me.Save.ImageIndex = 4
        Me.Save.Location = New System.Drawing.Point(30, 331)
        Me.Save.Name = "Save"
        Me.Save.Size = New System.Drawing.Size(57, 46)
        Me.Save.TabIndex = 25
        Me.Save.UseVisualStyleBackColor = True
        '
        'Label1
        '
        Me.Label1.AutoSize = True
        Me.Label1.Location = New System.Drawing.Point(26, 25)
        Me.Label1.Name = "Label1"
        Me.Label1.Size = New System.Drawing.Size(70, 20)
        Me.Label1.TabIndex = 23
        Me.Label1.Text = "Employé"
        '
        'Label2
        '
        Me.Label2.AutoSize = True
        Me.Label2.Location = New System.Drawing.Point(26, 172)
        Me.Label2.Name = "Label2"
        Me.Label2.Size = New System.Drawing.Size(115, 20)
        Me.Label2.TabIndex = 30
        Me.Label2.Text = "Heure d'entrée"
        '
        'Label4
        '
        Me.Label4.AutoSize = True
        Me.Label4.Location = New System.Drawing.Point(26, 248)
        Me.Label4.Name = "Label4"
        Me.Label4.Size = New System.Drawing.Size(109, 20)
        Me.Label4.TabIndex = 31
        Me.Label4.Text = "Type pointage"
        '
        'Label5
        '
        Me.Label5.AutoSize = True
        Me.Label5.Location = New System.Drawing.Point(228, 172)
        Me.Label5.Name = "Label5"
        Me.Label5.Size = New System.Drawing.Size(118, 20)
        Me.Label5.TabIndex = 32
        Me.Label5.Text = "Heure de sortie"
        '
        'Label6
        '
        Me.Label6.AutoSize = True
        Me.Label6.Location = New System.Drawing.Point(26, 331)
        Me.Label6.Name = "Label6"
        Me.Label6.Size = New System.Drawing.Size(104, 20)
        Me.Label6.TabIndex = 33
        Me.Label6.Text = "Commentaire"
        '
        'heureentree
        '
        Me.heureentree.Font = New System.Drawing.Font("Microsoft Sans Serif", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.heureentree.Format = System.Windows.Forms.DateTimePickerFormat.Time
        Me.heureentree.Location = New System.Drawing.Point(30, 198)
        Me.heureentree.Name = "heureentree"
        Me.heureentree.Size = New System.Drawing.Size(157, 35)
        Me.heureentree.TabIndex = 34
        '
        'heuresortie
        '
        Me.heuresortie.Font = New System.Drawing.Font("Microsoft Sans Serif", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.heuresortie.Format = System.Windows.Forms.DateTimePickerFormat.Time
        Me.heuresortie.Location = New System.Drawing.Point(232, 198)
        Me.heuresortie.Name = "heuresortie"
        Me.heuresortie.Size = New System.Drawing.Size(157, 35)
        Me.heuresortie.TabIndex = 35
        '
        'typepointage
        '
        Me.typepointage.Font = New System.Drawing.Font("Microsoft Sans Serif", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.typepointage.FormattingEnabled = True
        Me.typepointage.Items.AddRange(New Object() {"REGULIER ", "HEURES SUPPLEMENTAIRES ", "ABSENCE ", "RETARD ", "DEPART ANTICIPE "})
        Me.typepointage.Location = New System.Drawing.Point(30, 271)
        Me.typepointage.Name = "typepointage"
        Me.typepointage.Size = New System.Drawing.Size(358, 37)
        Me.typepointage.TabIndex = 36
        '
        'notes
        '
        Me.notes.Font = New System.Drawing.Font("Microsoft Sans Serif", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.notes.Location = New System.Drawing.Point(32, 362)
        Me.notes.Multiline = True
        Me.notes.Name = "notes"
        Me.notes.Size = New System.Drawing.Size(360, 149)
        Me.notes.TabIndex = 37
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
        'Button1
        '
        Me.Button1.FlatAppearance.BorderSize = 0
        Me.Button1.FlatAppearance.MouseOverBackColor = System.Drawing.Color.FromArgb(CType(CType(128, Byte), Integer), CType(CType(255, Byte), Integer), CType(CType(255, Byte), Integer))
        Me.Button1.FlatStyle = System.Windows.Forms.FlatStyle.Flat
        Me.Button1.ImageIndex = 4
        Me.Button1.ImageList = Me.ImageList1
        Me.Button1.Location = New System.Drawing.Point(30, 542)
        Me.Button1.Name = "Button1"
        Me.Button1.Size = New System.Drawing.Size(57, 46)
        Me.Button1.TabIndex = 38
        Me.Button1.UseVisualStyleBackColor = True
        '
        'ligne_modifie
        '
        Me.ligne_modifie.AutoSize = True
        Me.ligne_modifie.Location = New System.Drawing.Point(141, 11)
        Me.ligne_modifie.Name = "ligne_modifie"
        Me.ligne_modifie.Size = New System.Drawing.Size(102, 20)
        Me.ligne_modifie.TabIndex = 41
        Me.ligne_modifie.Text = "ligne_modifie"
        Me.ligne_modifie.Visible = False
        '
        'type_operation
        '
        Me.type_operation.AutoSize = True
        Me.type_operation.Location = New System.Drawing.Point(249, 11)
        Me.type_operation.Name = "type_operation"
        Me.type_operation.Size = New System.Drawing.Size(115, 20)
        Me.type_operation.TabIndex = 40
        Me.type_operation.Text = "type_operation"
        Me.type_operation.Visible = False
        '
        'ancien_idpointage
        '
        Me.ancien_idpointage.Location = New System.Drawing.Point(369, 11)
        Me.ancien_idpointage.Name = "ancien_idpointage"
        Me.ancien_idpointage.Size = New System.Drawing.Size(217, 26)
        Me.ancien_idpointage.TabIndex = 39
        Me.ancien_idpointage.Visible = False
        '
        'pointage_form
        '
        Me.AcceptButton = Me.Button1
        Me.AutoScaleDimensions = New System.Drawing.SizeF(9.0!, 20.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.ClientSize = New System.Drawing.Size(423, 598)
        Me.Controls.Add(Me.ligne_modifie)
        Me.Controls.Add(Me.type_operation)
        Me.Controls.Add(Me.ancien_idpointage)
        Me.Controls.Add(Me.Button1)
        Me.Controls.Add(Me.notes)
        Me.Controls.Add(Me.typepointage)
        Me.Controls.Add(Me.heuresortie)
        Me.Controls.Add(Me.heureentree)
        Me.Controls.Add(Me.Label6)
        Me.Controls.Add(Me.Label5)
        Me.Controls.Add(Me.Label4)
        Me.Controls.Add(Me.Label2)
        Me.Controls.Add(Me.datepointage)
        Me.Controls.Add(Me.Label3)
        Me.Controls.Add(Me.idemploye)
        Me.Controls.Add(Me.Save)
        Me.Controls.Add(Me.Label1)
        Me.Name = "pointage_form"
        Me.Text = "pointage_form"
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents datepointage As System.Windows.Forms.DateTimePicker
    Friend WithEvents Label3 As System.Windows.Forms.Label
    Friend WithEvents idemploye As System.Windows.Forms.ComboBox
    Friend WithEvents Save As System.Windows.Forms.Button
    Friend WithEvents Label1 As System.Windows.Forms.Label
    Friend WithEvents Label2 As System.Windows.Forms.Label
    Friend WithEvents Label4 As System.Windows.Forms.Label
    Friend WithEvents Label5 As System.Windows.Forms.Label
    Friend WithEvents Label6 As System.Windows.Forms.Label
    Friend WithEvents heureentree As System.Windows.Forms.DateTimePicker
    Friend WithEvents heuresortie As System.Windows.Forms.DateTimePicker
    Friend WithEvents typepointage As System.Windows.Forms.ComboBox
    Friend WithEvents notes As System.Windows.Forms.TextBox
    Friend WithEvents ImageList1 As System.Windows.Forms.ImageList
    Friend WithEvents Button1 As System.Windows.Forms.Button
    Friend WithEvents ligne_modifie As System.Windows.Forms.Label
    Friend WithEvents type_operation As System.Windows.Forms.Label
    Friend WithEvents ancien_idpointage As System.Windows.Forms.TextBox
End Class
