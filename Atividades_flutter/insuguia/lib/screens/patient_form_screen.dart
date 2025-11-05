import 'package:flutter/material.dart';
import '../database_helper.dart';

class PatientFormScreen extends StatefulWidget {
  const PatientFormScreen({super.key});

  @override
  State<PatientFormScreen> createState() => _PatientFormScreenState();
}

class _PatientFormScreenState extends State<PatientFormScreen> {
  final _formKey = GlobalKey<FormState>();

  final TextEditingController _nameController = TextEditingController();
  final TextEditingController _ageController = TextEditingController();
  final TextEditingController _weightController = TextEditingController();
  final TextEditingController _heightController = TextEditingController();
  final TextEditingController _creatinineController = TextEditingController();
  final TextEditingController _locationController = TextEditingController();

  bool _usoCorticoide = false;
  String _dispositivo = '1/1 unidade';
  String _sexoSelecionado = 'Masculino';

  Future<void> _salvarPaciente() async {
    if (_formKey.currentState!.validate()) {
      try {
        final idade = int.tryParse(_ageController.text);
        final peso = double.tryParse(_weightController.text);
        final altura = double.tryParse(_heightController.text);
        final creatinina = _creatinineController.text.isNotEmpty
            ? double.tryParse(_creatinineController.text)
            : null;

        if (idade == null || peso == null || altura == null) {
          ScaffoldMessenger.of(context).showSnackBar(
            const SnackBar(content: Text('Verifique os valores numéricos digitados.')),
          );
          return;
        }

        final data = {
          'nome': _nameController.text,
          'sexo': _sexoSelecionado,
          'idade': idade,
          'peso': peso,
          'altura': altura,
          'creatinina': creatinina,
          'local_internacao': _locationController.text,
          'uso_corticoide': _usoCorticoide ? 1 : 0,
          'dispositivo': _dispositivo,
        };

        final id = await DatabaseHelper.instance.insertPaciente(data);
        print('✅ Paciente inserido com ID: $id');

        if (mounted) {
          ScaffoldMessenger.of(context).showSnackBar(
            const SnackBar(content: Text('Paciente cadastrado com sucesso!')),
          );
          Navigator.pop(context);
        }
      } catch (e) {
        print('❌ Erro ao salvar paciente: $e');
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text('Erro ao salvar paciente: $e')),
        );
      }
    }
  }

  void _mostrarInfo(String titulo, String mensagem) {
    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        title: Text(titulo),
        content: Text(mensagem),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context),
            child: const Text('Fechar'),
          )
        ],
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Cadastro de Paciente')),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Form(
          key: _formKey,
          child: ListView(
            children: [
              TextFormField(
                controller: _nameController,
                decoration: const InputDecoration(
                  labelText: 'Nome',
                  border: OutlineInputBorder(),
                ),
                validator: (v) => v == null || v.isEmpty ? 'Informe o nome' : null,
              ),
              const SizedBox(height: 12),

              DropdownButtonFormField<String>(
                value: _sexoSelecionado,
                decoration: const InputDecoration(
                  labelText: 'Sexo',
                  border: OutlineInputBorder(),
                ),
                items: const [
                  DropdownMenuItem(value: 'Masculino', child: Text('Masculino')),
                  DropdownMenuItem(value: 'Feminino', child: Text('Feminino')),
                ],
                onChanged: (v) => setState(() => _sexoSelecionado = v!),
              ),
              const SizedBox(height: 12),

              TextFormField(
                controller: _ageController,
                decoration: const InputDecoration(
                  labelText: 'Idade',
                  border: OutlineInputBorder(),
                ),
                keyboardType: TextInputType.number,
                validator: (v) => v == null || v.isEmpty ? 'Informe a idade' : null,
              ),
              const SizedBox(height: 12),

              TextFormField(
                controller: _weightController,
                decoration: const InputDecoration(
                  labelText: 'Peso (kg)',
                  border: OutlineInputBorder(),
                ),
                keyboardType:
                    const TextInputType.numberWithOptions(decimal: true),
                validator: (v) => v == null || v.isEmpty ? 'Informe o peso' : null,
              ),
              const SizedBox(height: 12),

              TextFormField(
                controller: _heightController,
                decoration: const InputDecoration(
                  labelText: 'Altura (cm)',
                  border: OutlineInputBorder(),
                ),
                keyboardType:
                    const TextInputType.numberWithOptions(decimal: true),
                validator: (v) => v == null || v.isEmpty ? 'Informe a altura' : null,
              ),
              const SizedBox(height: 12),

              Row(
                children: [
                  Expanded(
                    child: TextFormField(
                      controller: _creatinineController,
                      decoration: const InputDecoration(
                        labelText: 'Creatinina (mg/dL)',
                        border: OutlineInputBorder(),
                      ),
                      keyboardType:
                          const TextInputType.numberWithOptions(decimal: true),
                    ),
                  ),
                  IconButton(
                    tooltip: 'O que é creatinina?',
                    icon: const Icon(Icons.info_outline),
                    onPressed: () => _mostrarInfo(
                      'Creatinina',
                      'A creatinina é uma substância medida no sangue usada para avaliar o funcionamento dos rins e auxiliar no cálculo da TFG (Taxa de Filtração Glomerular).',
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 12),

              Row(
                children: [
                  Expanded(
                    child: TextFormField(
                      controller: _locationController,
                      decoration: const InputDecoration(
                        labelText: 'Local de Internação',
                        border: OutlineInputBorder(),
                      ),
                    ),
                  ),
                  IconButton(
                    tooltip: 'O que é o local de internação?',
                    icon: const Icon(Icons.info_outline),
                    onPressed: () => _mostrarInfo(
                      'Local de Internação',
                      'Refere-se ao setor do hospital onde o paciente está internado (ex: enfermaria, UTI, pronto-socorro).',
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 12),

              SwitchListTile(
                title: const Text('Paciente em uso de corticoide?'),
                value: _usoCorticoide,
                onChanged: (v) => setState(() => _usoCorticoide = v),
              ),
              const SizedBox(height: 12),

              DropdownButtonFormField<String>(
                decoration: const InputDecoration(
                  labelText: 'Dispositivo de aplicação',
                  border: OutlineInputBorder(),
                ),
                value: _dispositivo,
                items: const [
                  DropdownMenuItem(value: '1/1 unidade', child: Text('1/1 unidade')),
                  DropdownMenuItem(value: '2/2 unidades', child: Text('2/2 unidades')),
                ],
                onChanged: (v) => setState(() => _dispositivo = v!),
              ),
              const SizedBox(height: 20),

              ElevatedButton(
                onPressed: _salvarPaciente,
                style: ElevatedButton.styleFrom(
                  minimumSize: const Size(double.infinity, 48),
                ),
                child: const Text('Salvar Cadastro', style: TextStyle(fontSize: 18)),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
