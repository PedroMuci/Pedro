import 'package:flutter/material.dart';
import 'screens/home_screen.dart';
import 'screens/patient_form_screen.dart';

final Map<String, WidgetBuilder> appRoutes = {
  '/': (context) => const HomeScreen(),
  '/patient-form': (context) => const PatientFormScreen(),
};
