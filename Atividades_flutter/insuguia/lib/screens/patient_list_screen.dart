import 'package:flutter/material.dart';
import '../database_helper.dart';

class PatientListScreen extends StatefulWidget {
  const PatientListScreen({super.key});

  @override
  State<PatientListScreen> createState() => _PatientListScreenState();
}

class _PatientListScreenState extends State<PatientListScreen> {
  List<Map<String, dynamic>> pacientes = [];

  @override
  void initState() {
    super.initState();
    _carregarPacientes();
  }

  Future<void> _carregarPacientes() async {
    final data = await DatabaseHelper.instance.getPacientes();
    setState(() {
      pacientes = data;
    });
  }

  Future<void> _excluirPaciente(int id) async {
    await DatabaseHelper.instance.deletePaciente(id);
    _carregarPacientes();
    if (mounted) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Paciente removido com sucesso!')),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Lista de Pacientes'),
        centerTitle: true,
      ),
      body: pacientes.isEmpty
          ? const Center(
              child: Text(
                'Nenhum paciente cadastrado ainda.',
                style: TextStyle(fontSize: 16),
              ),
            )
          : RefreshIndicator(
              onRefresh: _carregarPacientes,
              child: ListView.builder(
                padding: const EdgeInsets.all(12.0),
                itemCount: pacientes.length,
                itemBuilder: (context, index) {
                  final paciente = pacientes[index];
                  return Card(
                    margin: const EdgeInsets.symmetric(vertical: 6),
                    elevation: 2,
                    child: ListTile(
                      title: Text(
                        paciente['nome'],
                        style: const TextStyle(fontWeight: FontWeight.bold),
                      ),
                      subtitle: Text(
                        'Idade: ${paciente['idade']} anos\n'
                        'Sexo: ${paciente['sexo']}',
                      ),
                      isThreeLine: true,
                      trailing: IconButton(
                        icon: const Icon(Icons.delete, color: Colors.red),
                        onPressed: () => _excluirPaciente(paciente['id']),
                      ),
                    ),
                  );
                },
              ),
            ),
    );
  }
}
