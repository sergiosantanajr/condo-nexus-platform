
import { Building, FileText, Shield, Wrench, Users, Phone } from "lucide-react";
import { Link } from "react-router-dom";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { Button } from "@/components/ui/button";

const services = [
  {
    icon: <Building className="h-10 w-10 text-brand-teal" />,
    title: "Administração de Condomínios",
    description: "Gestão completa e personalizada para seu condomínio com transparência e eficiência.",
    link: "/servicos/administracao",
    features: ["Gestão financeira", "Assembleias", "Documentação legal", "Prestação de contas"]
  },
  {
    icon: <FileText className="h-10 w-10 text-brand-teal" />,
    title: "Consultoria Condominial",
    description: "Orientação especializada em questões legais, financeiras e administrativas.",
    link: "/servicos/consultoria",
    features: ["Orientação jurídica", "Análise financeira", "Planejamento estratégico", "Adequação à legislação"]
  },
  {
    icon: <Users className="h-10 w-10 text-brand-teal" />,
    title: "Assembleias e Reuniões",
    description: "Organização e condução profissional de assembleias e reuniões condominiais.",
    link: "/servicos/assembleias",
    features: ["Preparação de pautas", "Condução de reuniões", "Registro de atas", "Deliberações eficientes"]
  },
  {
    icon: <Wrench className="h-10 w-10 text-brand-teal" />,
    title: "Manutenção Preventiva",
    description: "Planejamento e execução de manutenções para preservar o patrimônio e evitar problemas.",
    link: "/servicos/manutencao",
    features: ["Vistorias periódicas", "Relatórios técnicos", "Orçamentos", "Acompanhamento de obras"]
  },
  {
    icon: <Shield className="h-10 w-10 text-brand-teal" />,
    title: "Segurança Condominial",
    description: "Soluções integradas para garantir a segurança dos moradores e do patrimônio.",
    link: "/servicos/seguranca",
    features: ["Controle de acesso", "Monitoramento", "Protocolos de segurança", "Treinamento de equipe"]
  },
  {
    icon: <Phone className="h-10 w-10 text-brand-teal" />,
    title: "Atendimento 24h",
    description: "Suporte e atendimento para emergências e necessidades a qualquer hora.",
    link: "/servicos/atendimento",
    features: ["Plantão 24 horas", "Resposta rápida", "Resolução de emergências", "Suporte contínuo"]
  }
];

const ServicesSection = () => {
  return (
    <section className="py-20 bg-white" id="servicos">
      <div className="container mx-auto px-4">
        <div className="text-center mb-16">
          <h2 className="text-3xl md:text-4xl font-bold mb-4 text-brand-blue">
            Nossos Serviços
          </h2>
          <div className="w-20 h-1 bg-brand-teal mx-auto mb-8"></div>
          <p className="text-xl text-gray-600 max-w-3xl mx-auto">
            Oferecemos soluções completas para administração e gestão de condomínios residenciais e comerciais.
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          {services.map((service, index) => (
            <Card key={index} className="h-full transition-all duration-300 hover:shadow-lg overflow-hidden">
              <CardHeader>
                <div className="mb-4">
                  {service.icon}
                </div>
                <CardTitle className="text-xl font-bold text-brand-blue">
                  {service.title}
                </CardTitle>
              </CardHeader>
              <CardContent className="flex flex-col h-full">
                <CardDescription className="text-gray-600 mb-4">
                  {service.description}
                </CardDescription>
                
                <ul className="mt-2 mb-6 space-y-1 flex-grow">
                  {service.features.map((feature, idx) => (
                    <li key={idx} className="flex items-center text-sm text-gray-600">
                      <span className="mr-2 text-brand-teal">•</span>
                      {feature}
                    </li>
                  ))}
                </ul>
                
                <Link to={service.link} className="mt-auto">
                  <Button className="w-full bg-brand-blue hover:bg-blue-800 transition-colors">
                    Saiba Mais
                  </Button>
                </Link>
              </CardContent>
            </Card>
          ))}
        </div>
        
        <div className="text-center mt-12">
          <Link to="/servicos">
            <Button variant="outline" className="border-brand-teal text-brand-teal hover:bg-brand-teal hover:text-white">
              Ver Todos os Serviços
            </Button>
          </Link>
        </div>
      </div>
    </section>
  );
};

export default ServicesSection;
