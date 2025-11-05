import 'package:flutter/material.dart';

class AboutScreen extends StatelessWidget {
  const AboutScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Sobre o Aplicativo'),
        centerTitle: true,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: ListView(
          children: const [
            Text(
              'InsuGuia Mobile',
              style: TextStyle(
                fontSize: 22,
                fontWeight: FontWeight.bold,
              ),
            ),
            SizedBox(height: 16),
            Text(
              'O InsuGuia Mobile é um protótipo acadêmico desenvolvido para auxiliar profissionais '
              'de saúde no acompanhamento de pacientes que fazem uso de insulina. '
              'O aplicativo permite o cadastro de pacientes, registro de dados clínicos e acompanhamento diário.',
              style: TextStyle(fontSize: 16),
              textAlign: TextAlign.justify,
            ),
            SizedBox(height: 24),
            Text(
              'Versão: 1.0.0\n'
              'Desenvolvido como parte de um projeto de extensão do curso de Sistemas de Informação.\n\n'
              'Este aplicativo não substitui a orientação médica. Os dados apresentados têm caráter educativo e acadêmico.',
              style: TextStyle(fontSize: 15),
            ),
          ],
        ),
      ),
    );
  }
}
