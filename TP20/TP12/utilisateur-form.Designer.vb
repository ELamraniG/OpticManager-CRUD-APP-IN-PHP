<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class utilisateur_form
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
        Me.GroupBox1 = New System.Windows.Forms.GroupBox()
        Me.motdepasseutilisateur = New System.Windows.Forms.TextBox()
        Me.Label4 = New System.Windows.Forms.Label()
        Me.loginutilisateur = New System.Windows.Forms.TextBox()
        Me.typeutilisateur = New System.Windows.Forms.TextBox()
        Me.Label2 = New System.Windows.Forms.Label()
        Me.Label3 = New System.Windows.Forms.Label()
        Me.idemploye = New System.Windows.Forms.ComboBox()
        Me.Label1 = New System.Windows.Forms.Label()
        Me.GroupBox2 = New System.Windows.Forms.GroupBox()
        Me.enregistrer = New System.Windows.Forms.Button()
        Me.toutCochez = New System.Windows.Forms.Button()
        Me.decochezTout = New System.Windows.Forms.Button()
        Me.type_operation = New System.Windows.Forms.Label()
        Me.ancien_iduser = New System.Windows.Forms.TextBox()
        Me.GroupBox1.SuspendLayout()
        Me.SuspendLayout()
        '
        'GroupBox1
        '
        Me.GroupBox1.Controls.Add(Me.motdepasseutilisateur)
        Me.GroupBox1.Controls.Add(Me.Label4)
        Me.GroupBox1.Controls.Add(Me.loginutilisateur)
        Me.GroupBox1.Controls.Add(Me.typeutilisateur)
        Me.GroupBox1.Controls.Add(Me.Label2)
        Me.GroupBox1.Controls.Add(Me.Label3)
        Me.GroupBox1.Controls.Add(Me.idemploye)
        Me.GroupBox1.Controls.Add(Me.Label1)
        Me.GroupBox1.Location = New System.Drawing.Point(39, 23)
        Me.GroupBox1.Name = "GroupBox1"
        Me.GroupBox1.Size = New System.Drawing.Size(1478, 174)
        Me.GroupBox1.TabIndex = 35
        Me.GroupBox1.TabStop = False
        Me.GroupBox1.Text = "Utilisateur"
        '
        'motdepasseutilisateur
        '
        Me.motdepasseutilisateur.Location = New System.Drawing.Point(712, 123)
        Me.motdepasseutilisateur.Name = "motdepasseutilisateur"
        Me.motdepasseutilisateur.Size = New System.Drawing.Size(388, 26)
        Me.motdepasseutilisateur.TabIndex = 42
        '
        'Label4
        '
        Me.Label4.AutoSize = True
        Me.Label4.Location = New System.Drawing.Point(708, 100)
        Me.Label4.Name = "Label4"
        Me.Label4.Size = New System.Drawing.Size(105, 20)
        Me.Label4.TabIndex = 41
        Me.Label4.Text = "Mot de passe"
        '
        'loginutilisateur
        '
        Me.loginutilisateur.Location = New System.Drawing.Point(26, 123)
        Me.loginutilisateur.Name = "loginutilisateur"
        Me.loginutilisateur.Size = New System.Drawing.Size(388, 26)
        Me.loginutilisateur.TabIndex = 40
        '
        'typeutilisateur
        '
        Me.typeutilisateur.Location = New System.Drawing.Point(712, 52)
        Me.typeutilisateur.Name = "typeutilisateur"
        Me.typeutilisateur.Size = New System.Drawing.Size(218, 26)
        Me.typeutilisateur.TabIndex = 39
        Me.typeutilisateur.Text = "Admin"
        '
        'Label2
        '
        Me.Label2.AutoSize = True
        Me.Label2.Location = New System.Drawing.Point(22, 100)
        Me.Label2.Name = "Label2"
        Me.Label2.Size = New System.Drawing.Size(48, 20)
        Me.Label2.TabIndex = 38
        Me.Label2.Text = "Login"
        '
        'Label3
        '
        Me.Label3.AutoSize = True
        Me.Label3.Location = New System.Drawing.Point(708, 29)
        Me.Label3.Name = "Label3"
        Me.Label3.Size = New System.Drawing.Size(292, 20)
        Me.Label3.TabIndex = 37
        Me.Label3.Text = "Type d'utilisation (Admin = Pouvoir Total)"
        '
        'idemploye
        '
        Me.idemploye.Font = New System.Drawing.Font("Microsoft Sans Serif", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.idemploye.FormattingEnabled = True
        Me.idemploye.Location = New System.Drawing.Point(26, 52)
        Me.idemploye.Name = "idemploye"
        Me.idemploye.Size = New System.Drawing.Size(388, 37)
        Me.idemploye.TabIndex = 36
        '
        'Label1
        '
        Me.Label1.AutoSize = True
        Me.Label1.Location = New System.Drawing.Point(22, 29)
        Me.Label1.Name = "Label1"
        Me.Label1.Size = New System.Drawing.Size(70, 20)
        Me.Label1.TabIndex = 35
        Me.Label1.Text = "Employé"
        '
        'GroupBox2
        '
        Me.GroupBox2.Location = New System.Drawing.Point(39, 284)
        Me.GroupBox2.Name = "GroupBox2"
        Me.GroupBox2.Size = New System.Drawing.Size(1478, 394)
        Me.GroupBox2.TabIndex = 36
        Me.GroupBox2.TabStop = False
        Me.GroupBox2.Text = "Cochez les options à autoriser"
        '
        'enregistrer
        '
        Me.enregistrer.Location = New System.Drawing.Point(39, 684)
        Me.enregistrer.Name = "enregistrer"
        Me.enregistrer.Size = New System.Drawing.Size(157, 56)
        Me.enregistrer.TabIndex = 37
        Me.enregistrer.Text = "Enregistrer"
        Me.enregistrer.UseVisualStyleBackColor = True
        '
        'toutCochez
        '
        Me.toutCochez.BackColor = System.Drawing.Color.FromArgb(CType(CType(0, Byte), Integer), CType(CType(0, Byte), Integer), CType(CType(192, Byte), Integer))
        Me.toutCochez.ForeColor = System.Drawing.Color.White
        Me.toutCochez.Location = New System.Drawing.Point(544, 212)
        Me.toutCochez.Name = "toutCochez"
        Me.toutCochez.Size = New System.Drawing.Size(201, 69)
        Me.toutCochez.TabIndex = 45
        Me.toutCochez.Text = "Cochez tout (ADMIN)"
        Me.toutCochez.UseVisualStyleBackColor = False
        '
        'decochezTout
        '
        Me.decochezTout.BackColor = System.Drawing.Color.FromArgb(CType(CType(0, Byte), Integer), CType(CType(192, Byte), Integer), CType(CType(192, Byte), Integer))
        Me.decochezTout.ForeColor = System.Drawing.Color.White
        Me.decochezTout.Location = New System.Drawing.Point(751, 212)
        Me.decochezTout.Name = "decochezTout"
        Me.decochezTout.Size = New System.Drawing.Size(201, 69)
        Me.decochezTout.TabIndex = 46
        Me.decochezTout.Text = "Décochez tout"
        Me.decochezTout.UseVisualStyleBackColor = False
        '
        'type_operation
        '
        Me.type_operation.AutoSize = True
        Me.type_operation.Location = New System.Drawing.Point(873, 1)
        Me.type_operation.Name = "type_operation"
        Me.type_operation.Size = New System.Drawing.Size(115, 20)
        Me.type_operation.TabIndex = 48
        Me.type_operation.Text = "type_operation"
        Me.type_operation.Visible = False
        '
        'ancien_iduser
        '
        Me.ancien_iduser.Location = New System.Drawing.Point(993, 1)
        Me.ancien_iduser.Name = "ancien_iduser"
        Me.ancien_iduser.Size = New System.Drawing.Size(217, 26)
        Me.ancien_iduser.TabIndex = 47
        Me.ancien_iduser.Visible = False
        '
        'utilisateur_form
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(9.0!, 20.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.ClientSize = New System.Drawing.Size(1548, 752)
        Me.Controls.Add(Me.type_operation)
        Me.Controls.Add(Me.ancien_iduser)
        Me.Controls.Add(Me.decochezTout)
        Me.Controls.Add(Me.toutCochez)
        Me.Controls.Add(Me.enregistrer)
        Me.Controls.Add(Me.GroupBox2)
        Me.Controls.Add(Me.GroupBox1)
        Me.Name = "utilisateur_form"
        Me.Text = "utilisateur_form"
        Me.GroupBox1.ResumeLayout(False)
        Me.GroupBox1.PerformLayout()
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents GroupBox1 As System.Windows.Forms.GroupBox
    Friend WithEvents motdepasseutilisateur As System.Windows.Forms.TextBox
    Friend WithEvents Label4 As System.Windows.Forms.Label
    Friend WithEvents loginutilisateur As System.Windows.Forms.TextBox
    Friend WithEvents typeutilisateur As System.Windows.Forms.TextBox
    Friend WithEvents Label2 As System.Windows.Forms.Label
    Friend WithEvents Label3 As System.Windows.Forms.Label
    Friend WithEvents idemploye As System.Windows.Forms.ComboBox
    Friend WithEvents Label1 As System.Windows.Forms.Label
    Friend WithEvents GroupBox2 As System.Windows.Forms.GroupBox
    Friend WithEvents enregistrer As System.Windows.Forms.Button
    Friend WithEvents toutCochez As System.Windows.Forms.Button
    Friend WithEvents decochezTout As System.Windows.Forms.Button
    Friend WithEvents type_operation As System.Windows.Forms.Label
    Friend WithEvents ancien_iduser As System.Windows.Forms.TextBox
End Class
