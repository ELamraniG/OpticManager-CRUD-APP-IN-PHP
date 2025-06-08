<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class parametre
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
        Me.Label1 = New System.Windows.Forms.Label()
        Me.Label2 = New System.Windows.Forms.Label()
        Me.tsigle = New System.Windows.Forms.TextBox()
        Me.tnomentreprise = New System.Windows.Forms.TextBox()
        Me.Enregistrer = New System.Windows.Forms.Button()
        Me.Label3 = New System.Windows.Forms.Label()
        Me.Label4 = New System.Windows.Forms.Label()
        Me.dtp1 = New System.Windows.Forms.DateTimePicker()
        Me.dtp2 = New System.Windows.Forms.DateTimePicker()
        Me.SuspendLayout()
        '
        'Label1
        '
        Me.Label1.AutoSize = True
        Me.Label1.Location = New System.Drawing.Point(12, 26)
        Me.Label1.Name = "Label1"
        Me.Label1.Size = New System.Drawing.Size(44, 20)
        Me.Label1.TabIndex = 0
        Me.Label1.Text = "Sigle"
        '
        'Label2
        '
        Me.Label2.AutoSize = True
        Me.Label2.Location = New System.Drawing.Point(12, 94)
        Me.Label2.Name = "Label2"
        Me.Label2.Size = New System.Drawing.Size(145, 20)
        Me.Label2.TabIndex = 1
        Me.Label2.Text = "Nom de l'entreprise"
        '
        'tsigle
        '
        Me.tsigle.Location = New System.Drawing.Point(16, 49)
        Me.tsigle.Name = "tsigle"
        Me.tsigle.Size = New System.Drawing.Size(388, 26)
        Me.tsigle.TabIndex = 2
        '
        'tnomentreprise
        '
        Me.tnomentreprise.Location = New System.Drawing.Point(16, 117)
        Me.tnomentreprise.Name = "tnomentreprise"
        Me.tnomentreprise.Size = New System.Drawing.Size(388, 26)
        Me.tnomentreprise.TabIndex = 3
        '
        'Enregistrer
        '
        Me.Enregistrer.BackColor = System.Drawing.Color.Blue
        Me.Enregistrer.ForeColor = System.Drawing.Color.White
        Me.Enregistrer.Location = New System.Drawing.Point(12, 269)
        Me.Enregistrer.Name = "Enregistrer"
        Me.Enregistrer.Size = New System.Drawing.Size(141, 43)
        Me.Enregistrer.TabIndex = 4
        Me.Enregistrer.Text = "Enregistrer"
        Me.Enregistrer.UseVisualStyleBackColor = False
        '
        'Label3
        '
        Me.Label3.AutoSize = True
        Me.Label3.Location = New System.Drawing.Point(283, 163)
        Me.Label3.Name = "Label3"
        Me.Label3.Size = New System.Drawing.Size(118, 20)
        Me.Label3.TabIndex = 6
        Me.Label3.Text = "Heure de sortie"
        '
        'Label4
        '
        Me.Label4.AutoSize = True
        Me.Label4.Location = New System.Drawing.Point(12, 163)
        Me.Label4.Name = "Label4"
        Me.Label4.Size = New System.Drawing.Size(115, 20)
        Me.Label4.TabIndex = 5
        Me.Label4.Text = "Heure d'entrée"
        '
        'dtp1
        '
        Me.dtp1.Font = New System.Drawing.Font("Microsoft Sans Serif", 16.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.dtp1.Format = System.Windows.Forms.DateTimePickerFormat.Time
        Me.dtp1.Location = New System.Drawing.Point(16, 186)
        Me.dtp1.Name = "dtp1"
        Me.dtp1.Size = New System.Drawing.Size(117, 44)
        Me.dtp1.TabIndex = 9
        '
        'dtp2
        '
        Me.dtp2.Font = New System.Drawing.Font("Microsoft Sans Serif", 16.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.dtp2.Format = System.Windows.Forms.DateTimePickerFormat.Time
        Me.dtp2.Location = New System.Drawing.Point(287, 186)
        Me.dtp2.Name = "dtp2"
        Me.dtp2.Size = New System.Drawing.Size(117, 44)
        Me.dtp2.TabIndex = 10
        '
        'parametre
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(9.0!, 20.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.ClientSize = New System.Drawing.Size(468, 335)
        Me.Controls.Add(Me.dtp2)
        Me.Controls.Add(Me.dtp1)
        Me.Controls.Add(Me.Label3)
        Me.Controls.Add(Me.Label4)
        Me.Controls.Add(Me.Enregistrer)
        Me.Controls.Add(Me.tnomentreprise)
        Me.Controls.Add(Me.tsigle)
        Me.Controls.Add(Me.Label2)
        Me.Controls.Add(Me.Label1)
        Me.Name = "parametre"
        Me.Text = "parametre"
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents Label1 As System.Windows.Forms.Label
    Friend WithEvents Label2 As System.Windows.Forms.Label
    Friend WithEvents tsigle As System.Windows.Forms.TextBox
    Friend WithEvents tnomentreprise As System.Windows.Forms.TextBox
    Friend WithEvents Enregistrer As System.Windows.Forms.Button
    Friend WithEvents Label3 As System.Windows.Forms.Label
    Friend WithEvents Label4 As System.Windows.Forms.Label
    Friend WithEvents dtp1 As System.Windows.Forms.DateTimePicker
    Friend WithEvents dtp2 As System.Windows.Forms.DateTimePicker
End Class
