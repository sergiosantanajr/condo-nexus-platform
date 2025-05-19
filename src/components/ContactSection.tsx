
import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Textarea } from "@/components/ui/textarea";
import { useToast } from "@/components/ui/use-toast";
import { Check, MapPin, Phone, Mail, Clock } from "lucide-react";

const ContactSection = () => {
  const { toast } = useToast();
  const [formState, setFormState] = useState({
    name: "",
    email: "",
    phone: "",
    message: "",
  });
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [isSubmitted, setIsSubmitted] = useState(false);

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    setFormState({
      ...formState,
      [e.target.name]: e.target.value
    });
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setIsSubmitting(true);
    
    // Simulate form submission
    setTimeout(() => {
      setIsSubmitting(false);
      setIsSubmitted(true);
      toast({
        title: "Mensagem enviada!",
        description: "Entraremos em contato em breve.",
      });
      
      // Reset form after a moment
      setTimeout(() => {
        setIsSubmitted(false);
        setFormState({
          name: "",
          email: "",
          phone: "",
          message: "",
        });
      }, 3000);
    }, 1000);
  };

  return (
    <section className="py-20 bg-white">
      <div className="container mx-auto px-4">
        <div className="text-center mb-16">
          <h2 className="text-3xl md:text-4xl font-bold mb-4 text-brand-blue">
            Entre em Contato
          </h2>
          <div className="w-20 h-1 bg-brand-teal mx-auto mb-8"></div>
          <p className="text-xl text-gray-600 max-w-3xl mx-auto">
            Estamos prontos para ajudar com suas necessidades condominiais.
          </p>
        </div>

        <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
          {/* Contact Form */}
          <div className="bg-white rounded-lg shadow-lg p-8">
            {isSubmitted ? (
              <div className="flex flex-col items-center justify-center py-12">
                <div className="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6">
                  <Check className="h-8 w-8 text-green-600" />
                </div>
                <h3 className="text-2xl font-bold text-gray-800 mb-2">Mensagem Enviada!</h3>
                <p className="text-gray-600 text-center">
                  Obrigado por entrar em contato. Responderemos o mais breve possível.
                </p>
              </div>
            ) : (
              <form onSubmit={handleSubmit} className="space-y-6">
                <div>
                  <label htmlFor="name" className="block text-sm font-medium text-gray-700 mb-1">
                    Nome Completo
                  </label>
                  <Input
                    id="name"
                    name="name"
                    value={formState.name}
                    onChange={handleChange}
                    required
                    placeholder="Seu nome completo"
                  />
                </div>
                
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <label htmlFor="email" className="block text-sm font-medium text-gray-700 mb-1">
                      Email
                    </label>
                    <Input
                      id="email"
                      name="email"
                      type="email"
                      value={formState.email}
                      onChange={handleChange}
                      required
                      placeholder="seu@email.com"
                    />
                  </div>
                  <div>
                    <label htmlFor="phone" className="block text-sm font-medium text-gray-700 mb-1">
                      Telefone
                    </label>
                    <Input
                      id="phone"
                      name="phone"
                      value={formState.phone}
                      onChange={handleChange}
                      placeholder="(11) 99999-9999"
                    />
                  </div>
                </div>
                
                <div>
                  <label htmlFor="message" className="block text-sm font-medium text-gray-700 mb-1">
                    Mensagem
                  </label>
                  <Textarea
                    id="message"
                    name="message"
                    rows={5}
                    value={formState.message}
                    onChange={handleChange}
                    required
                    placeholder="Como podemos ajudar?"
                    className="resize-none"
                  />
                </div>
                
                <Button 
                  type="submit" 
                  className="w-full bg-brand-blue hover:bg-blue-800"
                  disabled={isSubmitting}
                >
                  {isSubmitting ? "Enviando..." : "Enviar Mensagem"}
                </Button>
              </form>
            )}
          </div>
          
          {/* Contact Info */}
          <div className="lg:pl-8">
            <h3 className="text-2xl font-bold text-gray-800 mb-6">
              Informações de Contato
            </h3>
            
            <div className="space-y-8">
              <div className="flex">
                <div className="flex-shrink-0 h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                  <MapPin className="h-6 w-6 text-brand-blue" />
                </div>
                <div>
                  <h4 className="text-lg font-semibold text-gray-800">Endereço</h4>
                  <p className="text-gray-600 mt-1">
                    Av. Paulista, 1000, Conjunto 101<br />
                    Bela Vista, São Paulo - SP, 01310-100
                  </p>
                </div>
              </div>
              
              <div className="flex">
                <div className="flex-shrink-0 h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                  <Phone className="h-6 w-6 text-brand-blue" />
                </div>
                <div>
                  <h4 className="text-lg font-semibold text-gray-800">Telefone</h4>
                  <p className="text-gray-600 mt-1">
                    <a href="tel:+551155555555" className="hover:text-brand-teal">
                      (11) 5555-5555
                    </a>
                  </p>
                </div>
              </div>
              
              <div className="flex">
                <div className="flex-shrink-0 h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                  <Mail className="h-6 w-6 text-brand-blue" />
                </div>
                <div>
                  <h4 className="text-lg font-semibold text-gray-800">Email</h4>
                  <p className="text-gray-600 mt-1">
                    <a href="mailto:contato@novaalternativa.com" className="hover:text-brand-teal">
                      contato@novaalternativa.com
                    </a>
                  </p>
                </div>
              </div>
              
              <div className="flex">
                <div className="flex-shrink-0 h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                  <Clock className="h-6 w-6 text-brand-blue" />
                </div>
                <div>
                  <h4 className="text-lg font-semibold text-gray-800">Horário de Atendimento</h4>
                  <p className="text-gray-600 mt-1">
                    Segunda a Sexta: 09:00 - 18:00<br />
                    Sábado: 09:00 - 12:00
                  </p>
                </div>
              </div>
            </div>
            
            {/* Map Placeholder */}
            <div className="mt-8 rounded-lg overflow-hidden h-[200px] bg-gray-200 flex items-center justify-center">
              <p className="text-gray-500">Mapa será carregado aqui</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default ContactSection;
