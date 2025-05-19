
import { Building, FileText, Shield, Tool, Users, Phone } from "lucide-react";
import { Link } from "react-router-dom";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";

const services = [
  {
    icon: <Building className="h-10 w-10 text-brand-teal" />,
    title: "Administração de Condomínios",
    description: "Gestão completa e personalizada para seu condomínio com transparência e eficiência.",
    link: "/servicos/administracao"
  },
  {
    icon: <FileText className="h-10 w-10 text-brand-teal" />,
    title: "Consultoria Condominial",
    description: "Orientação especializada em questões legais, financeiras e administrativas.",
    link: "/servicos/consultoria"
  },
  {
    icon: <Users className="h-10 w-10 text-brand-teal" />,
    title: "Assembleias e Reuniões",
    description: "Organização e condução profissional de assembleias e reuniões condominiais.",
    link: "/servicos/assembleias"
  },
  {
    icon: <Tool className="h-10 w-10 text-brand-teal" />,
    title: "Manutenção Preventiva",
    description: "Planejamento e execução de manutenções para preservar o patrimônio e evitar problemas.",
    link: "/servicos/manutencao"
  },
  {
    icon: <Shield className="h-10 w-10 text-brand-teal" />,
    title: "Segurança Condominial",
    description: "Soluções integradas para garantir a segurança dos moradores e do patrimônio.",
    link: "/servicos/seguranca"
  },
  {
    icon: <Phone className="h-10 w-10 text-brand-teal" />,
    title: "Atendimento 24h",
    description: "Suporte e atendimento para emergências e necessidades a qualquer hora.",
    link: "/servicos/atendimento"
  }
];

const ServicesSection = () => {
  return (
    <section className="py-20 bg-white">
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
            <Link to={service.link} key={index} className="group">
              <Card className="h-full transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                <CardHeader>
                  <div className="mb-4">
                    {service.icon}
                  </div>
                  <CardTitle className="text-xl font-bold text-brand-blue group-hover:text-brand-teal transition-colors">
                    {service.title}
                  </CardTitle>
                </CardHeader>
                <CardContent>
                  <CardDescription className="text-gray-600">
                    {service.description}
                  </CardDescription>
                </CardContent>
              </Card>
            </Link>
          ))}
        </div>
      </div>
    </section>
  );
};

export default ServicesSection;
